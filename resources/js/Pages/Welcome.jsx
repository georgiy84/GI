import React from 'react';

export default function Welcome() {
    return (
        <div className="min-h-screen bg-gray-100 flex items-center justify-center">
            <div className="text-center">
                <h1 className="text-4xl font-bold mb-6 text-gray-800">
                    ¡Bienvenido a Laravel + React!
                </h1>
                <div className="flex justify-center gap-4">
                    <a
                        href="/login"
                        className="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600"
                    >
                        Log in
                    </a>
                    <a
                        href="/register"
                        className="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600"
                    >
                        Register
                    </a>
                </div>
            </div>
        </div>
    );
}
