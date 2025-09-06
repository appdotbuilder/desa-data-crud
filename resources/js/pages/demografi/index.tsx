import React from 'react';
import AppLayout from '@/layouts/app-layout';
import { type BreadcrumbItem } from '@/types';
import { Head, Link, router } from '@inertiajs/react';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
    {
        title: 'Data Demografi',
        href: '/demografi',
    },
];

interface DemografiPenduduk {
    id: number;
    kk: string;
    nik: string;
    nama: string;
    jenis_kelamin: string;
    tanggal_lahir: string;
    alamat: string;
    pendidikan_terakhir: string;
    agama: string;
    pekerjaan: string;
    desa: {
        nama: string;
        kecamatan: {
            nama: string;
            kabupaten: {
                nama: string;
            };
        };
    };
}

interface PaginatedData {
    data: DemografiPenduduk[];
    current_page: number;
    last_page: number;
    per_page: number;
    total: number;
}

interface Props {
    demografi: PaginatedData;
    can_create: boolean;
    [key: string]: unknown;
}

export default function DemografiIndex({ demografi, can_create }: Props) {

    const handleDelete = (id: number) => {
        if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
            router.delete(route('demografi.destroy', id), {
                preserveState: true,
                onSuccess: () => {
                    alert('Data berhasil dihapus!');
                }
            });
        }
    };

    const getEducationLabel = (education: string) => {
        const labels = {
            'sd': 'SD',
            'sltp': 'SLTP',
            'slta': 'SLTA',
            's1': 'S1',
            's2': 'S2',
            's3': 'S3',
        };
        return labels[education as keyof typeof labels] || education;
    };

    const getAgamaLabel = (agama: string) => {
        const labels = {
            'islam': 'Islam',
            'katolik': 'Katolik',
            'protestan': 'Protestan',
            'hindu': 'Hindu',
            'budha': 'Budha',
            'konghucu': 'Konghucu',
            'kepercayaan': 'Kepercayaan',
        };
        return labels[agama as keyof typeof labels] || agama;
    };

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Data Demografi Penduduk" />
            <div className="flex h-full flex-1 flex-col gap-6 rounded-xl p-6 overflow-x-auto">
                {/* Header */}
                <div className="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <div>
                        <h1 className="text-3xl font-bold text-gray-900 dark:text-gray-100">
                            👥 Data Demografi Penduduk
                        </h1>
                        <p className="text-gray-600 dark:text-gray-400 mt-1">
                            Kelola data kependudukan desa
                        </p>
                    </div>
                    {can_create && (
                        <Link
                            href={route('demografi.create')}
                            className="inline-flex items-center px-4 py-2 bg-gradient-to-r from-green-500 to-blue-500 text-white font-medium rounded-lg hover:from-green-600 hover:to-blue-600 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1"
                        >
                            ➕ Tambah Data
                        </Link>
                    )}
                </div>

                {/* Statistics Cards */}
                <div className="grid grid-cols-1 md:grid-cols-4 gap-6">
                    <div className="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-200 dark:border-gray-700">
                        <div className="flex items-center justify-between">
                            <div>
                                <p className="text-sm font-medium text-gray-600 dark:text-gray-400">Total Penduduk</p>
                                <p className="text-3xl font-bold text-gray-900 dark:text-gray-100 mt-2">
                                    {demografi.total.toLocaleString()}
                                </p>
                            </div>
                            <div className="w-12 h-12 rounded-lg bg-gradient-to-r from-blue-500 to-blue-600 flex items-center justify-center text-white text-xl">
                                👥
                            </div>
                        </div>
                    </div>

                    <div className="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-200 dark:border-gray-700">
                        <div className="flex items-center justify-between">
                            <div>
                                <p className="text-sm font-medium text-gray-600 dark:text-gray-400">Laki-laki</p>
                                <p className="text-3xl font-bold text-gray-900 dark:text-gray-100 mt-2">
                                    {demografi.data.filter(d => d.jenis_kelamin === 'laki-laki').length}
                                </p>
                            </div>
                            <div className="w-12 h-12 rounded-lg bg-gradient-to-r from-blue-500 to-blue-600 flex items-center justify-center text-white text-xl">
                                👨
                            </div>
                        </div>
                    </div>

                    <div className="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-200 dark:border-gray-700">
                        <div className="flex items-center justify-between">
                            <div>
                                <p className="text-sm font-medium text-gray-600 dark:text-gray-400">Perempuan</p>
                                <p className="text-3xl font-bold text-gray-900 dark:text-gray-100 mt-2">
                                    {demografi.data.filter(d => d.jenis_kelamin === 'perempuan').length}
                                </p>
                            </div>
                            <div className="w-12 h-12 rounded-lg bg-gradient-to-r from-pink-500 to-pink-600 flex items-center justify-center text-white text-xl">
                                👩
                            </div>
                        </div>
                    </div>

                    <div className="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-200 dark:border-gray-700">
                        <div className="flex items-center justify-between">
                            <div>
                                <p className="text-sm font-medium text-gray-600 dark:text-gray-400">Halaman</p>
                                <p className="text-3xl font-bold text-gray-900 dark:text-gray-100 mt-2">
                                    {demografi.current_page} / {demografi.last_page}
                                </p>
                            </div>
                            <div className="w-12 h-12 rounded-lg bg-gradient-to-r from-purple-500 to-purple-600 flex items-center justify-center text-white text-xl">
                                📄
                            </div>
                        </div>
                    </div>
                </div>

                {/* Data Table */}
                <div className="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
                    <div className="overflow-x-auto">
                        <table className="w-full">
                            <thead className="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Data Penduduk
                                    </th>
                                    <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Lokasi
                                    </th>
                                    <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Detail
                                    </th>
                                    {can_create && (
                                        <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Aksi
                                        </th>
                                    )}
                                </tr>
                            </thead>
                            <tbody className="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                {demografi.data.map((item) => (
                                    <tr key={item.id} className="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                        <td className="px-6 py-4 whitespace-nowrap">
                                            <div className="flex items-center">
                                                <div className={`flex-shrink-0 h-10 w-10 rounded-full flex items-center justify-center text-white font-bold ${
                                                    item.jenis_kelamin === 'laki-laki' ? 'bg-blue-500' : 'bg-pink-500'
                                                }`}>
                                                    {item.jenis_kelamin === 'laki-laki' ? '👨' : '👩'}
                                                </div>
                                                <div className="ml-4">
                                                    <div className="text-sm font-medium text-gray-900 dark:text-gray-100">
                                                        {item.nama}
                                                    </div>
                                                    <div className="text-sm text-gray-500 dark:text-gray-400">
                                                        NIK: {item.nik}
                                                    </div>
                                                    <div className="text-sm text-gray-500 dark:text-gray-400">
                                                        KK: {item.kk}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td className="px-6 py-4 whitespace-nowrap">
                                            <div className="text-sm text-gray-900 dark:text-gray-100">
                                                🏘️ {item.desa.nama}
                                            </div>
                                            <div className="text-sm text-gray-500 dark:text-gray-400">
                                                🏢 {item.desa.kecamatan.nama}
                                            </div>
                                            <div className="text-sm text-gray-500 dark:text-gray-400">
                                                🏛️ {item.desa.kecamatan.kabupaten.nama}
                                            </div>
                                        </td>
                                        <td className="px-6 py-4 whitespace-nowrap">
                                            <div className="text-sm text-gray-900 dark:text-gray-100">
                                                🎓 {getEducationLabel(item.pendidikan_terakhir)}
                                            </div>
                                            <div className="text-sm text-gray-500 dark:text-gray-400">
                                                🙏 {getAgamaLabel(item.agama)}
                                            </div>
                                            <div className="text-sm text-gray-500 dark:text-gray-400">
                                                💼 {item.pekerjaan}
                                            </div>
                                        </td>
                                        {can_create && (
                                            <td className="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <div className="flex items-center space-x-2">
                                                    <Link
                                                        href={route('demografi.show', item.id)}
                                                        className="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300 transition-colors"
                                                    >
                                                        👁️ Lihat
                                                    </Link>
                                                    <Link
                                                        href={route('demografi.edit', item.id)}
                                                        className="text-yellow-600 hover:text-yellow-900 dark:text-yellow-400 dark:hover:text-yellow-300 transition-colors"
                                                    >
                                                        ✏️ Edit
                                                    </Link>
                                                    <button
                                                        onClick={() => handleDelete(item.id)}
                                                        className="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300 transition-colors"
                                                    >
                                                        🗑️ Hapus
                                                    </button>
                                                </div>
                                            </td>
                                        )}
                                    </tr>
                                ))}
                            </tbody>
                        </table>
                    </div>

                    {demografi.data.length === 0 && (
                        <div className="text-center py-12">
                            <div className="text-6xl mb-4">📊</div>
                            <h3 className="text-lg font-medium text-gray-900 dark:text-gray-100 mb-2">
                                Belum ada data demografi
                            </h3>
                            <p className="text-gray-500 dark:text-gray-400 mb-4">
                                Mulai tambahkan data penduduk untuk melihat statistik
                            </p>
                            {can_create && (
                                <Link
                                    href={route('demografi.create')}
                                    className="inline-flex items-center px-4 py-2 bg-gradient-to-r from-green-500 to-blue-500 text-white font-medium rounded-lg hover:from-green-600 hover:to-blue-600 transition-all duration-300"
                                >
                                    ➕ Tambah Data Pertama
                                </Link>
                            )}
                        </div>
                    )}
                </div>

                {/* Pagination */}
                {demografi.last_page > 1 && (
                    <div className="flex justify-between items-center">
                        <div className="text-sm text-gray-700 dark:text-gray-300">
                            Menampilkan {((demografi.current_page - 1) * demografi.per_page) + 1} sampai{' '}
                            {Math.min(demografi.current_page * demografi.per_page, demografi.total)} dari{' '}
                            {demografi.total} hasil
                        </div>
                        <div className="flex items-center space-x-2">
                            {demografi.current_page > 1 && (
                                <Link
                                    href={route('demografi.index', { page: demografi.current_page - 1 })}
                                    className="px-3 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-md hover:bg-gray-50 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400 dark:hover:bg-gray-700"
                                >
                                    ← Sebelumnya
                                </Link>
                            )}
                            {demografi.current_page < demografi.last_page && (
                                <Link
                                    href={route('demografi.index', { page: demografi.current_page + 1 })}
                                    className="px-3 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-md hover:bg-gray-50 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400 dark:hover:bg-gray-700"
                                >
                                    Selanjutnya →
                                </Link>
                            )}
                        </div>
                    </div>
                )}
            </div>
        </AppLayout>
    );
}