import React from 'react';
import { Head, Link } from '@inertiajs/react';
import { AppShell } from '@/components/app-shell';
import { Button } from '@/components/ui/button';

interface Props {
    stats: {
        total_members: number;
        active_members: number;
        training_members: number;
        deployed_members: number;
        total_programs: number;
        active_programs: number;
        ongoing_trainings: number;
        completed_trainings: number;
        total_income: number;
        total_expense: number;
        balance: number;
    };
    recentMembers: Array<{
        id: number;
        member_number: string;
        full_name: string;
        status: string;
        created_at: string;
    }>;
    recentTransactions: Array<{
        id: number;
        transaction_number: string;
        type: string;
        description: string;
        amount: number;
        created_at: string;
        member?: {
            full_name: string;
        };
    }>;
    [key: string]: unknown;
}

export default function Dashboard({ stats, recentMembers, recentTransactions }: Props) {
    const formatCurrency = (amount: number) => {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0,
        }).format(amount);
    };

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
            <Head title="Dashboard - SIMTKM" />
            
            <div className="space-y-6">
                {/* Header */}
                <div className="flex justify-between items-center">
                    <div>
                        <h1 className="text-2xl font-bold text-gray-900">📊 Dashboard SIMTKM</h1>
                        <p className="text-gray-600">Ringkasan data tenaga kerja migran</p>
                    </div>
                </div>

                {/* Stats Grid */}
                <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div className="bg-white p-6 rounded-lg shadow border">
                        <div className="flex items-center">
                            <div className="text-3xl mr-4">👥</div>
                            <div>
                                <p className="text-sm font-medium text-gray-600">Total Anggota</p>
                                <p className="text-2xl font-bold text-gray-900">{stats.total_members}</p>
                            </div>
                        </div>
                    </div>

                    <div className="bg-white p-6 rounded-lg shadow border">
                        <div className="flex items-center">
                            <div className="text-3xl mr-4">✅</div>
                            <div>
                                <p className="text-sm font-medium text-gray-600">Anggota Aktif</p>
                                <p className="text-2xl font-bold text-green-600">{stats.active_members}</p>
                            </div>
                        </div>
                    </div>

                    <div className="bg-white p-6 rounded-lg shadow border">
                        <div className="flex items-center">
                            <div className="text-3xl mr-4">🎓</div>
                            <div>
                                <p className="text-sm font-medium text-gray-600">Sedang Pelatihan</p>
                                <p className="text-2xl font-bold text-blue-600">{stats.training_members}</p>
                            </div>
                        </div>
                    </div>

                    <div className="bg-white p-6 rounded-lg shadow border">
                        <div className="flex items-center">
                            <div className="text-3xl mr-4">🌍</div>
                            <div>
                                <p className="text-sm font-medium text-gray-600">Ditempatkan</p>
                                <p className="text-2xl font-bold text-purple-600">{stats.deployed_members}</p>
                            </div>
                        </div>
                    </div>
                </div>

                {/* Training & Finance Stats */}
                <div className="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div className="bg-white p-6 rounded-lg shadow border">
                        <h3 className="text-lg font-semibold mb-4">📚 Program Pelatihan</h3>
                        <div className="space-y-4">
                            <div className="flex justify-between">
                                <span className="text-gray-600">Total Program:</span>
                                <span className="font-semibold">{stats.total_programs}</span>
                            </div>
                            <div className="flex justify-between">
                                <span className="text-gray-600">Program Aktif:</span>
                                <span className="font-semibold text-green-600">{stats.active_programs}</span>
                            </div>
                            <div className="flex justify-between">
                                <span className="text-gray-600">Pelatihan Berlangsung:</span>
                                <span className="font-semibold text-blue-600">{stats.ongoing_trainings}</span>
                            </div>
                            <div className="flex justify-between">
                                <span className="text-gray-600">Pelatihan Selesai:</span>
                                <span className="font-semibold text-purple-600">{stats.completed_trainings}</span>
                            </div>
                        </div>
                    </div>

                    <div className="bg-white p-6 rounded-lg shadow border">
                        <h3 className="text-lg font-semibold mb-4">💰 Ringkasan Keuangan</h3>
                        <div className="space-y-4">
                            <div className="flex justify-between">
                                <span className="text-gray-600">Total Pemasukan:</span>
                                <span className="font-semibold text-green-600">{formatCurrency(stats.total_income)}</span>
                            </div>
                            <div className="flex justify-between">
                                <span className="text-gray-600">Total Pengeluaran:</span>
                                <span className="font-semibold text-red-600">{formatCurrency(stats.total_expense)}</span>
                            </div>
                            <div className="border-t pt-2">
                                <div className="flex justify-between">
                                    <span className="text-gray-600 font-medium">Saldo:</span>
                                    <span className={`font-bold ${stats.balance >= 0 ? 'text-green-600' : 'text-red-600'}`}>
                                        {formatCurrency(stats.balance)}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {/* Recent Activities */}
                <div className="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div className="bg-white p-6 rounded-lg shadow border">
                        <div className="flex justify-between items-center mb-4">
                            <h3 className="text-lg font-semibold">👤 Anggota Terbaru</h3>
                            <Link href="/members">
                                <Button variant="outline" size="sm">Lihat Semua</Button>
                            </Link>
                        </div>
                        <div className="space-y-3">
                            {recentMembers.map((member) => (
                                <div key={member.id} className="flex justify-between items-center py-2 border-b last:border-b-0">
                                    <div>
                                        <p className="font-medium">{member.full_name}</p>
                                        <p className="text-sm text-gray-500">{member.member_number}</p>
                                    </div>
                                    <div className="text-right">
                                        {getStatusBadge(member.status)}
                                        <p className="text-xs text-gray-500 mt-1">{formatDate(member.created_at)}</p>
                                    </div>
                                </div>
                            ))}
                        </div>
                    </div>

                    <div className="bg-white p-6 rounded-lg shadow border">
                        <div className="flex justify-between items-center mb-4">
                            <h3 className="text-lg font-semibold">💳 Transaksi Terbaru</h3>
                            <Link href="/financial-transactions">
                                <Button variant="outline" size="sm">Lihat Semua</Button>
                            </Link>
                        </div>
                        <div className="space-y-3">
                            {recentTransactions.map((transaction) => (
                                <div key={transaction.id} className="flex justify-between items-center py-2 border-b last:border-b-0">
                                    <div>
                                        <p className="font-medium">{transaction.description}</p>
                                        <p className="text-sm text-gray-500">
                                            {transaction.member?.full_name || 'Transaksi Umum'}
                                        </p>
                                    </div>
                                    <div className="text-right">
                                        <p className={`font-semibold ${transaction.type === 'income' ? 'text-green-600' : 'text-red-600'}`}>
                                            {transaction.type === 'income' ? '+' : '-'}{formatCurrency(transaction.amount)}
                                        </p>
                                        <p className="text-xs text-gray-500">{formatDate(transaction.created_at)}</p>
                                    </div>
                                </div>
                            ))}
                        </div>
                    </div>
                </div>

                {/* Quick Actions */}
                <div className="bg-white p-6 rounded-lg shadow border">
                    <h3 className="text-lg font-semibold mb-4">⚡ Aksi Cepat</h3>
                    <div className="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <Link href="/members/create">
                            <Button variant="outline" className="w-full h-20 flex flex-col items-center justify-center">
                                <span className="text-2xl mb-1">👤</span>
                                <span className="text-sm">Tambah Anggota</span>
                            </Button>
                        </Link>
                        <Link href="/training-programs/create">
                            <Button variant="outline" className="w-full h-20 flex flex-col items-center justify-center">
                                <span className="text-2xl mb-1">📚</span>
                                <span className="text-sm">Buat Program</span>
                            </Button>
                        </Link>
                        <Link href="/financial-transactions/create">
                            <Button variant="outline" className="w-full h-20 flex flex-col items-center justify-center">
                                <span className="text-2xl mb-1">💰</span>
                                <span className="text-sm">Catat Transaksi</span>
                            </Button>
                        </Link>
                        <Link href="/members">
                            <Button variant="outline" className="w-full h-20 flex flex-col items-center justify-center">
                                <span className="text-2xl mb-1">📊</span>
                                <span className="text-sm">Lihat Laporan</span>
                            </Button>
                        </Link>
                    </div>
                </div>
            </div>
        </AppShell>
    );
}