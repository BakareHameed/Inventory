// import React, { useState, useEffect } from 'react';
// import axios from 'axios';

// const Inventory = () => {
//     const [products, setProducts] = useState([]);
//     const [newProduct, setNewProduct] = useState({ name: '', quantity: 0, price: 0 });

//     useEffect(() => {
//         // Fetch products from API
//         axios.get('/api/products')
//             .then((response) => setProducts(response.data))
//             .catch((error) => console.error('Error fetching products:', error));
//     }, []);

//     const handleRestock = (id) => {
//         axios.put(`/api/products/${id}`, { action: 'restock' })
//             .then(() => {
//                 setProducts((prev) =>
//                     prev.map((product) =>
//                         product.id === id ? { ...product, quantity: product.quantity + 10 } : product
//                     )
//                 );
//             });
//     };

//     const handleBuy = (id) => {
//         axios.put(`/api/products/${id}`, { action: 'buy' })
//             .then(() => {
//                 setProducts((prev) =>
//                     prev.map((product) =>
//                         product.id === id ? { ...product, quantity: Math.max(product.quantity - 1, 0) } : product
//                     )
//                 );
//             });
//     };

//     const handleAddProduct = () => {
//         axios.post('/api/products', newProduct)
//             .then((response) => setProducts([...products, response.data]))
//             .catch((error) => console.error('Error adding product:', error));
//     };

//     return (
//         <div className="container mx-auto p-4">
//             <h1 className="text-2xl font-bold text-center mb-4">Inventory Management</h1>
//             <div className="bg-white p-4 rounded shadow mb-4">
//                 <h2 className="font-semibold text-lg mb-2">Add New Product</h2>
//                 <div className="grid grid-cols-3 gap-4">
//                     <input
//                         type="text"
//                         placeholder="Product Name"
//                         value={newProduct.name}
//                         onChange={(e) => setNewProduct({ ...newProduct, name: e.target.value })}
//                         className="border p-2 rounded"
//                     />
//                     <input
//                         type="number"
//                         placeholder="Quantity"
//                         value={newProduct.quantity}
//                         onChange={(e) => setNewProduct({ ...newProduct, quantity: +e.target.value })}
//                         className="border p-2 rounded"
//                     />
//                     <input
//                         type="number"
//                         placeholder="Price"
//                         value={newProduct.price}
//                         onChange={(e) => setNewProduct({ ...newProduct, price: +e.target.value })}
//                         className="border p-2 rounded"
//                     />
//                     <button
//                         onClick={handleAddProduct}
//                         className="bg-blue-500 text-white p-2 rounded hover:bg-blue-600"
//                     >
//                         Add Product
//                     </button>
//                 </div>
//             </div>

//             <table className="table-auto w-full bg-white rounded shadow">
//                 <thead>
//                     <tr className="bg-gray-200">
//                         <th className="px-4 py-2">Product</th>
//                         <th className="px-4 py-2">Quantity</th>
//                         <th className="px-4 py-2">Price</th>
//                         <th className="px-4 py-2">Status</th>
//                         <th className="px-4 py-2">Actions</th>
//                     </tr>
//                 </thead>
//                 <tbody>
//                     {products.map((product) => (
//                         <tr key={product.id} className="text-center">
//                             <td className="px-4 py-2">{product.name}</td>
//                             <td className="px-4 py-2">{product.quantity}</td>
//                             <td className="px-4 py-2">${product.price.toFixed(2)}</td>
//                             <td className="px-4 py-2">
//                                 {product.quantity < 10 ? (
//                                     <span className="text-red-500">Low Stock</span>
//                                 ) : (
//                                     <span className="text-green-500">In Stock</span>
//                                 )}
//                             </td>
//                             <td className="px-4 py-2">
//                                 <button
//                                     onClick={() => handleRestock(product.id)}
//                                     className="bg-green-500 text-white px-2 py-1 rounded hover:bg-green-600 mx-1"
//                                 >
//                                     Restock
//                                 </button>
//                                 <button
//                                     onClick={() => handleBuy(product.id)}
//                                     className="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600 mx-1"
//                                 >
//                                     Buy
//                                 </button>
//                             </td>
//                         </tr>
//                     ))}
//                 </tbody>
//             </table>
//         </div>
//     );
// };

// export default Inventory;


import React, { useState } from 'react';

const Inventory = () => {
    const [products, setProducts] = useState([]); // Initialize with an empty array
    const [newProduct, setNewProduct] = useState({ name: '', quantity: 0, price: 0 });

    const handleRestock = (id) => {
        // Simulate restock action
        setProducts((prev) =>
            prev.map((product) =>
                product.id === id ? { ...product, quantity: product.quantity + 10 } : product
            )
        );
    };

    const handleBuy = (id) => {
        // Simulate buy action
        setProducts((prev) =>
            prev.map((product) =>
                product.id === id ? { ...product, quantity: Math.max(product.quantity - 1, 0) } : product
            )
        );
    };

    const handleAddProduct = () => {
        // Simulate adding a new product
        const newProductWithId = { ...newProduct, id: Date.now() }; // Add a unique id
        setProducts([...products, newProductWithId]);
        setNewProduct({ name: '', quantity: 0, price: 0 }); // Reset the form
    };

    return (
        <div className="container mx-auto p-4">
            <h1 className="text-2xl font-bold text-center mb-4">Inventory Management</h1>
            <div className="bg-white p-4 rounded shadow mb-4">
                <h2 className="font-semibold text-lg mb-2">Add New Product</h2>
                <div className="grid grid-cols-3 gap-4">
                    <input
                        type="text"
                        placeholder="Product Name"
                        value={newProduct.name}
                        onChange={(e) => setNewProduct({ ...newProduct, name: e.target.value })}
                        className="border p-2 rounded"
                    />
                    <input
                        type="number"
                        placeholder="Quantity"
                        value={newProduct.quantity}
                        onChange={(e) => setNewProduct({ ...newProduct, quantity: +e.target.value })}
                        className="border p-2 rounded"
                    />
                    <input
                        type="number"
                        placeholder="Price"
                        value={newProduct.price}
                        onChange={(e) => setNewProduct({ ...newProduct, price: +e.target.value })}
                        className="border p-2 rounded"
                    />
                    <button
                        onClick={handleAddProduct}
                        className="bg-blue-500 text-white p-2 rounded hover:bg-blue-600"
                    >
                        Add Product
                    </button>
                </div>
            </div>

            <table className="table-auto w-full bg-white rounded shadow">
                <thead>
                    <tr className="bg-gray-200">
                        <th className="px-4 py-2">Product</th>
                        <th className="px-4 py-2">Quantity</th>
                        <th className="px-4 py-2">Price</th>
                        <th className="px-4 py-2">Status</th>
                        <th className="px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    {products.map((product) => (
                        <tr key={product.id} className="text-center">
                            <td className="px-4 py-2">{product.name}</td>
                            <td className="px-4 py-2">{product.quantity}</td>
                            <td className="px-4 py-2">${product.price.toFixed(2)}</td>
                            <td className="px-4 py-2">
                                {product.quantity < 10 ? (
                                    <span className="text-red-500">Low Stock</span>
                                ) : (
                                    <span className="text-green-500">In Stock</span>
                                )}
                            </td>
                            <td className="px-4 py-2">
                                <button
                                    onClick={() => handleRestock(product.id)}
                                    className="bg-green-500 text-white px-2 py-1 rounded hover:bg-green-600 mx-1"
                                >
                                    Restock
                                </button>
                                <button
                                    onClick={() => handleBuy(product.id)}
                                    className="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600 mx-1"
                                >
                                    Buy
                                </button>
                            </td>
                        </tr>
                    ))}
                </tbody>
            </table>
        </div>
    );
};

export default Inventory;
