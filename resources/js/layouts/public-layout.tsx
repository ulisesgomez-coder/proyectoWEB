import { Link } from '@inertiajs/react';
import type { PropsWithChildren } from 'react';

export default function PublicLayout({
    children,
}: PropsWithChildren) {
    return (
        <div className="min-h-screen bg-slate-100">
            <header className="bg-emerald-700 text-white shadow">
                <div className="mx-auto flex max-w-7xl items-center justify-between px-6 py-4">
                    <Link
                        href="/principal"
                        className="text-xl font-bold"
                    >
                        Huertos Urbanos
                    </Link>

                    <nav className="flex items-center gap-6">
                        <Link
                            href="/principal"
                            className="hover:text-emerald-200"
                        >
                            Principal
                        </Link>

                        <Link
                            href="/huertos"
                            className="hover:text-emerald-200"
                        >
                            Huertos
                        </Link>

                        <Link
                            href="/contactos"
                            className="hover:text-emerald-200"
                        >
                            Contactos
                        </Link>

                        <Link
                            href="/administrador"
                            className="hover:text-emerald-200"
                        >
                            Administración
                        </Link>
                    </nav>
                </div>
            </header>

            <main className="mx-auto min-h-[calc(100vh-140px)] max-w-7xl px-6 py-10">
                {children}
            </main>

            <footer className="bg-slate-900 px-6 py-6 text-center text-slate-300">
                Plataforma de Huertos Urbanos
            </footer>
        </div>
    );
}