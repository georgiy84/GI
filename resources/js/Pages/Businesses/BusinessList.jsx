import React from 'react';

export default function BusinessList({ businesses, loading, onDelete }) {
    return (
        <div className="p-4">
            <h2 className="text-lg font-bold mb-4">Business Management</h2>
            {loading ? (
                <div className="text-center text-gray-500">Loading...</div>
            ) : (
                <table className="w-full border-collapse border border-gray-300">
                    <thead>
                        <tr className="bg-gray-200">
                            <th className="border border-gray-300 px-4 py-2">Logo</th>
                            <th className="border border-gray-300 px-4 py-2">Name</th>
                            <th className="border border-gray-300 px-4 py-2">Email</th>
                            <th className="border border-gray-300 px-4 py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        {businesses.length === 0 ? (
                            <tr>
                                <td colSpan="4" className="text-center text-gray-500 py-4">
                                    No businesses found.
                                </td>
                            </tr>
                        ) : (
                            businesses.map((business) => (
                                <tr key={business.id}>
                                    <td className="border border-gray-300 px-4 py-2">
                                        {business.logo ? (
                                            <img
                                                src={`/storage/${business.logo}`}
                                                alt={business.name}
                                                className="h-12 w-12 object-cover rounded-full"
                                            />
                                        ) : (
                                            <span>No Logo</span>
                                        )}
                                    </td>
                                    <td className="border border-gray-300 px-4 py-2">{business.name}</td>
                                    <td className="border border-gray-300 px-4 py-2">{business.email}</td>
                                    <td className="border border-gray-300 px-4 py-2">
                                        <button
                                            className="px-2 py-1 bg-red-500 text-white rounded hover:bg-red-600 mr-2"
                                            onClick={() => onDelete(business.id)}
                                        >
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                            ))
                        )}
                    </tbody>
                </table>
            )}
        </div>
    );
}
