import React, { useState, useEffect } from "react";
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head } from '@inertiajs/react';
import BusinessForm from './BusinessForm';
import BusinessList from './BusinessList';
import axios from "axios";

export default function Index({ auth }) {
    const [businesses, setBusinesses] = useState([]);
    const [loading, setLoading] = useState(true);

    const fetchBusinesses = async () => {
        try {
            const response = await axios.get("/api/businesses");
            setBusinesses(response.data);
        } catch (error) {
            console.error("Error fetching businesses:", error);
        } finally {
            setLoading(false);
        }
    };

    const handleDelete = async (id) => {
        if (!window.confirm("Are you sure you want to delete this business?")) return;
    
        try {
            await axios.delete(`/api/businesses/${id}`, {
                headers: {
                    Authorization: `Bearer ${localStorage.getItem('token')}`,
                },
            });
            fetchBusinesses();
            setBusinesses((prevBusinesses) => prevBusinesses.filter(b => b.id !== id));
        } catch (error) {
            console.error("Error deleting business:", error);
        }
    };

    const handleNewBusiness = () => {
        fetchBusinesses();
    };

    useEffect(() => {
        fetchBusinesses();
    }, []);

    return (
        <AuthenticatedLayout user={auth.user}>
            <Head title="Businesses" />
            <div className="container mx-auto">
                <BusinessForm onSuccess={handleNewBusiness} />
                <BusinessList businesses={businesses} loading={loading} onDelete={handleDelete} />
            </div>
        </AuthenticatedLayout>
    );
}
