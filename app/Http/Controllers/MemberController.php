<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MemberController extends Controller
{
    private function messages(): array
    {
        return [
            'phone.regex' => 'Nomor telepon hanya boleh berisi angka, spasi, tanda + dan -.',
        ];
    }

    public function index()
    {
        $members = Member::orderBy('name')->get();

        return view('members.index', compact('members'));
    }

    public function create()
    {
        return view('members.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'member_code' => 'required|string|max:20|unique:members,member_code',
            'phone'       => ['required', 'string', 'max:20', 'regex:/^[0-9+\-\s]+$/'],
            'address'     => 'nullable|string|max:255',
        ], $this->messages());

        Member::create($validated);

        return redirect()
            ->route('members.index')
            ->with('success', 'Data anggota berhasil ditambahkan.');
    }

    public function show(Member $member)
    {
        $borrowings = $member->borrowings()->latest()->get();

        return view('members.show', compact('member', 'borrowings'));
    }

    public function edit(Member $member)
    {
        return view('members.edit', compact('member'));
    }

    public function update(Request $request, Member $member)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'member_code' => [
                'required',
                'string',
                'max:20',
                Rule::unique('members', 'member_code')->ignore($member->id),
            ],
            'phone'       => ['required', 'string', 'max:20', 'regex:/^[0-9+\-\s]+$/'],
            'address'     => 'nullable|string|max:255',
        ], $this->messages());

        $member->update($validated);

        return redirect()
            ->route('members.index')
            ->with('success', 'Data anggota berhasil diperbarui.');
    }

    public function destroy(Member $member)
    {
        if ($member->borrowings()->exists()) {
            return redirect()
                ->route('members.index')
                ->with('error', 'Anggota tidak dapat dihapus karena memiliki riwayat peminjaman.');
        }

        $member->delete();

        return redirect()
            ->route('members.index')
            ->with('success', 'Data anggota berhasil dihapus.');
    }
}