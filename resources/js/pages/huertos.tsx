import { Head } from '@inertiajs/react';
import PublicLayout from '@/layouts/public-layout';

const huertos = [
    {
        id: 1,
        nombre: 'Huerto Comunitario Centro Universitario de Tonala',
        ciudad: 'Guadalajara',
        descripcion: 'Cultivo comunitario de hortalizas y frutas.',
    },
    {
        id: 2,
        nombre: 'Huerto Verde Norte',
        ciudad: 'Zapopan',
        descripcion: 'Producción urbana de jitomate, lechuga y chile.',
    },
    {
        id: 3,
        nombre: 'Huerto Colinas',
        ciudad: 'Tlaquepaque',
        descripcion: 'Espacio compartido para productores y vecinos.',
    },
];

export default function Huertos() {
    return (
        <PublicLayout>
            <Head title="Huertos" />

            <div className="mb-8">
                <h1 className="text-4xl font-bold text-slate-900">
                    Huertos disponibles
                </h1>

                <p className="mt-3 text-slate-600">
                    Conoce los espacios registrados en la plataforma.
                </p>
            </div>

            <div className="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                {huertos.map((huerto) => (
                    <article
                        key={huerto.id}
                        className="overflow-hidden rounded-xl bg-white shadow"
                    >
                        <div className="h-40 bg-emerald-200" />

                        <div className="p-6">
                            <h2 className="text-xl font-bold text-slate-900">
                                {huerto.nombre}
                            </h2>

                            <p className="mt-1 font-medium text-emerald-700">
                                {huerto.ciudad}
                            </p>

                            <p className="mt-4 text-slate-600">
                                {huerto.descripcion}
                            </p>

                            <button
                                type="button"
                                className="mt-6 rounded-lg bg-emerald-600 px-4 py-2 text-white hover:bg-emerald-700"
                            >
                                Consultar
                            </button>
                        </div>
                    </article>
                ))}
            </div>
        </PublicLayout>
    );
}