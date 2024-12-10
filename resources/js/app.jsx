import '../css/app.css';
import React from 'react';
import ReactDOM from 'react-dom/client';
import { BrowserRouter, Routes, Route } from 'react-router-dom';
import Inventory from './Inventory';
import Home from './Home';
import Storage from './Storage';
import Layout from './Layout'; // Import the Layout

const App = () => {
  return (
    <BrowserRouter>
      <Routes>
        <Route
          path="/"
          element={
            <Layout>
              <Home />
            </Layout>
          }
        />
        <Route
          path="/storage"
          element={
            <Layout>
              <Storage />
            </Layout>
          }
        />
        <Route
          path="/inventory"
          element={
            <Layout>
              <Inventory />
            </Layout>
          }
        />
      </Routes>
    </BrowserRouter>
  );
};

ReactDOM.createRoot(document.getElementById('app')).render(<App />);
