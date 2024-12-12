import React, { useState } from 'react';
import { FaBars, FaHome, FaBox, FaShoppingCart, FaSignOutAlt } from 'react-icons/fa';
import { Link } from 'react-router-dom'; // Import Link

const Layout = ({ children }) => {
    const [isSidebarOpen, setIsSidebarOpen] = useState(false);

    const toggleSidebar = () => {
        setIsSidebarOpen(!isSidebarOpen);
    };

    return (
        <div className="flex h-screen bg-gray-100">
            {/* Sidebar */}
            <div
                className={`fixed top-0 left-0 h-full bg-blue-500 text-white z-20 transform ${
                    isSidebarOpen ? 'translate-x-0' : '-translate-x-full'
                } transition-transform duration-300 lg:relative lg:translate-x-0 lg:w-1/5`}
            >
                <div className="flex items-center justify-center h-16 border-b border-blue-300">
                    <h1 className="text-xl font-bold">Inventory</h1>
                </div>
                <nav className="mt-4">
                    <ul>
                        <li className="px-4 py-2 hover:bg-blue-600">
                            <Link to="/home" className="flex items-center">
                                <FaHome className="inline-block mr-2" /> Dashboard
                            </Link>
                        </li>
                        <li className="px-4 py-2 hover:bg-blue-600">
                            <Link to="/inventory" className="flex items-center">
                                <FaBox className="inline-block mr-2" /> Inventory
                            </Link>
                        </li>
                        <li className="px-4 py-2 hover:bg-blue-600">
                            <Link to="/supplier" className="flex items-center">
                                <FaShoppingCart className="inline-block mr-2" /> Supplier
                            </Link>
                        </li>
                        <li className="px-4 py-2 hover:bg-blue-600">
                            <Link to="/purchase" className="flex items-center">
                                <FaSignOutAlt className="inline-block mr-2" /> Purchase
                            </Link>
                        </li>
                    </ul>
                </nav>
            </div>

            {/* Main Content */}
            <div className="flex-1 flex flex-col">
                {/* Navbar */}
                <div className="flex items-center justify-between h-16 bg-white shadow px-4 lg:px-6">
                    <button
                        onClick={toggleSidebar}
                        className="lg:hidden text-blue-500 hover:text-blue-600 focus:outline-none"
                    >
                        <FaBars size={24} />
                    </button>
                    <div className="hidden lg:flex items-center space-x-4">
                        <button className="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                            Profile
                        </button>
                        <button className="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                            Logout
                        </button>
                    </div>
                </div>

                {/* Content */}
                <main className="flex-1 p-4 overflow-y-auto">{children}</main>
            </div>

            {/* Backdrop for Sidebar */}
            {isSidebarOpen && (
                <div
                    className="fixed inset-0 bg-black bg-opacity-50 z-10 lg:hidden"
                    onClick={toggleSidebar}
                ></div>
            )}
        </div>
    );
};

export default Layout;
