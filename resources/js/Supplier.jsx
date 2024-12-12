import React, { useState } from 'react';

const Supplier = () => {
    const [suppliers, setSuppliers] = useState([]);
    const [newSupplier, setNewSupplier] = useState({
        contact_name: '',
        contact_email: '',
        contact_phone: '',
        address: '',
        socials: '',
    });

    const handleAddSupplier = () => {
        // Add the new supplier to the suppliers list
        setSuppliers([...suppliers, { ...newSupplier, id: Date.now() }]);
        setNewSupplier({
            contact_name: '',
            contact_email: '',
            contact_phone: '',
            address: '',
            socials: '',
        });
    };

    return (
        <div className="container mx-auto p-4">
            <h1 className="text-2xl font-bold mb-6 text-center">Manage Suppliers</h1>

            {/* Add Supplier Form */}
            <div className="bg-white p-6 rounded-lg shadow-md mb-8">
                <h2 className="text-xl font-semibold mb-4">Add New Supplier</h2>
                <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <input
                        type="text"
                        placeholder="Contact Name"
                        value={newSupplier.contact_name}
                        onChange={(e) =>
                            setNewSupplier({ ...newSupplier, contact_name: e.target.value })
                        }
                        className="border p-2 rounded w-full"
                    />
                    <input
                        type="email"
                        placeholder="Contact Email"
                        value={newSupplier.contact_email}
                        onChange={(e) =>
                            setNewSupplier({ ...newSupplier, contact_email: e.target.value })
                        }
                        className="border p-2 rounded w-full"
                    />
                    <input
                        type="text"
                        placeholder="Contact Phone"
                        value={newSupplier.contact_phone}
                        onChange={(e) =>
                            setNewSupplier({ ...newSupplier, contact_phone: e.target.value })
                        }
                        className="border p-2 rounded w-full"
                    />
                    <input
                        type="text"
                        placeholder="Address"
                        value={newSupplier.address}
                        onChange={(e) =>
                            setNewSupplier({ ...newSupplier, address: e.target.value })
                        }
                        className="border p-2 rounded w-full"
                    />
                    <input
                        type="text"
                        placeholder="Socials (e.g., Twitter, LinkedIn)"
                        value={newSupplier.socials}
                        onChange={(e) =>
                            setNewSupplier({ ...newSupplier, socials: e.target.value })
                        }
                        className="border p-2 rounded w-full"
                    />
                </div>
                <button
                    onClick={handleAddSupplier}
                    className="mt-4 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600"
                >
                    Add Supplier
                </button>
            </div>

            {/* Supplier List */}
            <div className="bg-white p-6 rounded-lg shadow-md">
                <h2 className="text-xl font-semibold mb-4">Supplier List</h2>
                <div className="overflow-x-auto">
                    <table className="w-full table-auto border-collapse">
                        <thead>
                            <tr className="bg-gray-200">
                                <th className="px-4 py-2 border">Contact Name</th>
                                <th className="px-4 py-2 border">Email</th>
                                <th className="px-4 py-2 border">Phone</th>
                                <th className="px-4 py-2 border">Address</th>
                                <th className="px-4 py-2 border">Socials</th>
                            </tr>
                        </thead>
                        <tbody>
                            {suppliers.length > 0 ? (
                                suppliers.map((supplier) => (
                                    <tr key={supplier.id} className="text-center border-t">
                                        <td className="px-4 py-2 border">{supplier.contact_name}</td>
                                        <td className="px-4 py-2 border">{supplier.contact_email}</td>
                                        <td className="px-4 py-2 border">{supplier.contact_phone}</td>
                                        <td className="px-4 py-2 border">{supplier.address}</td>
                                        <td className="px-4 py-2 border">{supplier.socials}</td>
                                    </tr>
                                ))
                            ) : (
                                <tr>
                                    <td
                                        colSpan="5"
                                        className="px-4 py-2 text-gray-500 text-center border"
                                    >
                                        No suppliers added yet.
                                    </td>
                                </tr>
                            )}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    );
};

export default Supplier;
