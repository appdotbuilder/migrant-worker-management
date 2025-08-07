import React from 'react';
import { Head, Link } from '@inertiajs/react';
import { AppShell } from '@/components/app-shell';
import { Button } from '@/components/ui/button';

interface Member {
    id: number;
    member_number: string;
    full_name: string;
    gender: string;
    phone: string;
    status: string;
    created_at: string;
}

interface Props {
    members: {
        data: Member[];
        current_page: number;
        last_page: number;
        per_page: number;
        total: number;
    };
    [key: string]: unknown;
}

export default function MembersIndex({ members }: Props) {
    const formatDate = (dateString: string) => {
        return new Date(dateString).toLocaleDateString('id-ID');
    };

    const getStatusBadge = (status: string) => {
        const statusMap = {
            active: { label: 'Aktif', color: 'bg-green-100 text-green-800' },
            training: { label: 'Pelatihan', color: 'bg-blue-100 text-blue-800' },
            deployed: { label: 'Ditempatkan', color: 'bg-purple-100 text-purple-800' },
            returned: { label: 'Kembali', color: 'bg-gray-100 text-gray-800' },
            inactive: { label: 'Tidak Aktif', color: 'bg-red-100 text-red-800' },
        };
        
        const statusInfo = statusMap[status as keyof typeof statusMap] || { label: status, color: 'bg-gray-100 text-gray-800' };
        
        return (
            <span className={`px-2 py-1 text-xs font-medium rounded-full ${statusInfo.color}`}>
                {statusInfo.label}
            </span>
        );
    };

    return (
        <AppShell>
            <Head title="Data Anggota - SIMTKM" />
            
            <div className="space-y-6">
                {/* Header */}
                <div className="flex justify-between items-center">
                    <div>
                        <h1 className="text-2xl font-bold text-gray-900">👥 Data Anggota</h1>
                        <p className="text-gray-600">Kelola data tenaga kerja migran</p>
                    </div>
                    <Link href="/members/create">
                        <Button>
                            ➕ Tambah Anggota
                        </Button>
                    </Link>
                </div>

                {/* Members Table */}
                <div className="bg-white shadow border rounded-lg overflow-hidden">
                    <div className="px-6 py-4 border-b border-gray-200">
                        <h3 className="text-lg font-medium">Daftar Anggota ({members.total})</h3>
                    </div>
                    
                    <div className="overflow-x-auto">
                        <table className="min-w-full divide-y divide-gray-200">
                            <thead className="bg-gray-50">
                                <tr>
                                    <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Anggota
                                    </th>
                                    <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Gender
                                    </th>
                                    <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Telepon
                                    </th>
                                    <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Terdaftar
                                    </th>
                                    <th className="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody className="bg-white divide-y divide-gray-200">
                                {members.data.map((member) => (
                                    <tr key={member.id} className="hover:bg-gray-50">
                                        <td className="px-6 py-4 whitespace-nowrap">
                                            <div>
                                                <div className="text-sm font-medium text-gray-900">
                                                    {member.full_name}
                                                </div>
                                                <div className="text-sm text-gray-500">
                                                    {member.member_number}
                                                </div>
                                            </div>
                                        </td>
                                        <td className="px-6 py-4 whitespace-nowrap">
                                            <span className="text-sm text-gray-900">
                                                {member.gender === 'male' ? '👨 Laki-laki' : '👩 Perempuan'}
                                            </span>
                                        </td>
                                        <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {member.phone}
                                        </td>
                                        <td className="px-6 py-4 whitespace-nowrap">
                                            {getStatusBadge(member.status)}
                                        </td>
                                        <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {formatDate(member.created_at)}
                                        </td>
                                        <td className="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <Link
                                                href={`/members/${member.id}`}
                                                className="text-indigo-600 hover:text-indigo-900 mr-3"
                                            >
                                                👁️ Lihat
                                            </Link>
                                            <Link
                                                href={`/members/${member.id}/edit`}
                                                className="text-gray-600 hover:text-gray-900"
                                            >
                                                ✏️ Edit
                                            </Link>
                                        </td>
                                    </tr>
                                ))}
                            </tbody>
                        </table>
                    </div>

                    {/* Pagination Info */}
                    {members.total > members.per_page && (
                        <div className="bg-white px-6 py-3 border-t border-gray-200">
                            <div className="flex items-center justify-between">
                                <div className="text-sm text-gray-700">
                                    Menampilkan {((members.current_page - 1) * members.per_page) + 1} sampai{' '}
                                    {Math.min(members.current_page * members.per_page, members.total)} dari{' '}
                                    {members.total} anggota
                                </div>
                                <div className="text-sm text-gray-500">
                                    Halaman {members.current_page} dari {members.last_page}
                                </div>
                            </div>
                        </div>
                    )}
                </div>

                {/* Empty State */}
                {members.data.length === 0 && (
                    <div className="text-center py-12">
                        <div className="text-6xl mb-4">👥</div>
                        <h3 className="text-lg font-medium text-gray-900 mb-2">
                            Belum ada anggota terdaftar
                        </h3>
                        <p className="text-gray-600 mb-6">
                            Mulai dengan mendaftarkan anggota pertama Anda
                        </p>
                        <Link href="/members/create">
                            <Button>
                                ➕ Tambah Anggota Pertama
                            </Button>
                        </Link>
                    </div>
                )}
            </div>
        </AppShell>
    );
}