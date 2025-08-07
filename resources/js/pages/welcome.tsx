import React from 'react';
import { Head, Link } from '@inertiajs/react';
import { Button } from '@/components/ui/button';

export default function Welcome() {
    return (
        <>
            <Head title="SIMTKM - Sistem Informasi Manajemen Tenaga Kerja Migran" />
            
            <div className="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100">
                {/* Header */}
                <header className="bg-white shadow-sm border-b">
                    <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div className="flex justify-between items-center h-16">
                            <div className="flex items-center space-x-3">
                                <div className="h-8 w-8 bg-blue-600 rounded-md flex items-center justify-center">
                                    <span className="text-white font-bold">S</span>
                                </div>
                                <h1 className="text-xl font-bold text-gray-900">SIMTKM</h1>
                            </div>
                            <div className="flex items-center space-x-4">
                                <Link href="/login">
                                    <Button variant="ghost">Masuk</Button>
                                </Link>
                                <Link href="/register">
                                    <Button>Daftar</Button>
                                </Link>
                            </div>
                        </div>
                    </div>
                </header>

                {/* Hero Section */}
                <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
                    <div className="text-center">
                        <div className="mb-8">
                            <h1 className="text-4xl md:text-6xl font-bold text-gray-900 mb-4">
                                🌍 SIMTKM
                            </h1>
                            <p className="text-xl md:text-2xl text-gray-600 mb-8">
                                Sistem Informasi Manajemen Tenaga Kerja Migran
                            </p>
                            <p className="text-lg text-gray-500 max-w-3xl mx-auto">
                                Platform digital komprehensif untuk mengelola seluruh aspek tenaga kerja migran,
                                dari pendaftaran hingga penempatan kerja di luar negeri.
                            </p>
                        </div>

                        <div className="flex flex-col sm:flex-row gap-4 justify-center mb-16">
                            <Link href="/login">
                                <Button size="lg" className="px-8">
                                    🚀 Mulai Sekarang
                                </Button>
                            </Link>
                            <Link href="/dashboard">
                                <Button variant="outline" size="lg" className="px-8">
                                    📊 Lihat Dashboard
                                </Button>
                            </Link>
                        </div>
                    </div>

                    {/* Features Grid */}
                    <div className="grid md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
                        <div className="bg-white p-6 rounded-lg shadow-md border">
                            <div className="text-3xl mb-4">👥</div>
                            <h3 className="text-xl font-semibold mb-2">Manajemen Anggota</h3>
                            <p className="text-gray-600">
                                Pendaftaran dan pengelolaan data lengkap tenaga kerja migran termasuk
                                informasi personal, keluarga, dan dokumen.
                            </p>
                        </div>

                        <div className="bg-white p-6 rounded-lg shadow-md border">
                            <div className="text-3xl mb-4">🎓</div>
                            <h3 className="text-xl font-semibold mb-2">Program Pelatihan</h3>
                            <p className="text-gray-600">
                                Manajemen program pelatihan khusus untuk mempersiapkan tenaga kerja
                                sebelum ditempatkan di luar negeri.
                            </p>
                        </div>

                        <div className="bg-white p-6 rounded-lg shadow-md border">
                            <div className="text-3xl mb-4">📋</div>
                            <h3 className="text-xl font-semibold mb-2">Administrasi Dokumen</h3>
                            <p className="text-gray-600">
                                Pengelolaan dokumen digital, upload file, verifikasi, dan tracking
                                status dokumen yang diperlukan.
                            </p>
                        </div>

                        <div className="bg-white p-6 rounded-lg shadow-md border">
                            <div className="text-3xl mb-4">💰</div>
                            <h3 className="text-xl font-semibold mb-2">Manajemen Keuangan</h3>
                            <p className="text-gray-600">
                                Pencatatan dan monitoring transaksi keuangan, penerimaan,
                                pengeluaran dengan laporan yang detail.
                            </p>
                        </div>

                        <div className="bg-white p-6 rounded-lg shadow-md border">
                            <div className="text-3xl mb-4">👨‍💼</div>
                            <h3 className="text-xl font-semibold mb-2">Multi-Role Access</h3>
                            <p className="text-gray-600">
                                Sistem role-based dengan akses berbeda untuk Admin, Staf Pendaftaran,
                                Pelatihan, Administrasi, dan Keuangan.
                            </p>
                        </div>

                        <div className="bg-white p-6 rounded-lg shadow-md border">
                            <div className="text-3xl mb-4">📊</div>
                            <h3 className="text-xl font-semibold mb-2">Laporan & Analytics</h3>
                            <p className="text-gray-600">
                                Dashboard interaktif dan laporan komprehensif untuk monitoring
                                dan evaluasi kinerja program.
                            </p>
                        </div>
                    </div>

                    {/* Key Benefits */}
                    <div className="bg-white rounded-xl p-8 shadow-lg border">
                        <h2 className="text-2xl font-bold text-center mb-8">
                            🏆 Keunggulan Sistem
                        </h2>
                        <div className="grid md:grid-cols-2 gap-6">
                            <div className="flex items-start space-x-3">
                                <div className="text-2xl">✅</div>
                                <div>
                                    <h4 className="font-semibold mb-1">Data Terintegrasi</h4>
                                    <p className="text-gray-600">Semua data tersimpan dalam satu sistem terpusat</p>
                                </div>
                            </div>
                            <div className="flex items-start space-x-3">
                                <div className="text-2xl">⚡</div>
                                <div>
                                    <h4 className="font-semibold mb-1">Proses Otomatis</h4>
                                    <p className="text-gray-600">Otomasi workflow dan generasi nomor anggota</p>
                                </div>
                            </div>
                            <div className="flex items-start space-x-3">
                                <div className="text-2xl">🔐</div>
                                <div>
                                    <h4 className="font-semibold mb-1">Keamanan Data</h4>
                                    <p className="text-gray-600">Sistem keamanan berlapis dengan role-based access</p>
                                </div>
                            </div>
                            <div className="flex items-start space-x-3">
                                <div className="text-2xl">📱</div>
                                <div>
                                    <h4 className="font-semibold mb-1">Mobile Friendly</h4>
                                    <p className="text-gray-600">Akses mudah dari berbagai perangkat</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {/* Call to Action */}
                    <div className="text-center mt-16">
                        <h2 className="text-3xl font-bold mb-4">
                            Siap untuk Digitalisasi Manajemen TKM?
                        </h2>
                        <p className="text-lg text-gray-600 mb-8">
                            Bergabunglah dengan platform modern untuk mengelola tenaga kerja migran secara efisien.
                        </p>
                        <div className="flex flex-col sm:flex-row gap-4 justify-center">
                            <Link href="/register">
                                <Button size="lg" className="px-8">
                                    🎯 Mulai Gratis Sekarang
                                </Button>
                            </Link>
                            <Link href="/login">
                                <Button variant="outline" size="lg" className="px-8">
                                    🔑 Masuk ke Akun
                                </Button>
                            </Link>
                        </div>
                    </div>
                </div>

                {/* Footer */}
                <footer className="bg-gray-900 text-white py-12">
                    <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div className="text-center">
                            <div className="flex items-center justify-center space-x-3 mb-4">
                                <div className="h-8 w-8 bg-white rounded-md flex items-center justify-center">
                                    <span className="text-blue-600 font-bold">S</span>
                                </div>
                                <h3 className="text-xl font-bold">SIMTKM</h3>
                            </div>
                            <p className="text-gray-400 mb-4">
                                Sistem Informasi Manajemen Tenaga Kerja Migran
                            </p>
                            <p className="text-sm text-gray-500">
                                © 2024 SIMTKM. Semua hak cipta dilindungi.
                            </p>
                        </div>
                    </div>
                </footer>
            </div>
        </>
    );
}