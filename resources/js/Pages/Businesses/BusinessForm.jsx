import React, { useState } from "react";
import axios from "axios";
import { toast } from "react-toastify";

export default function BusinessForm({ onSuccess }) {
    const [formData, setFormData] = useState({
        name: "",
        email: "",
        phone: "",
        address: "",
        description: "",
        logo: null,
    });

    const handleChange = (e) => {
        const { name, value } = e.target;
        setFormData({ ...formData, [name]: value });
    };

    const handleFileChange = (e) => {
        setFormData({ ...formData, logo: e.target.files[0] });
    };

    const handleSubmit = async (e) => {
        e.preventDefault();
        const data = new FormData();
        Object.keys(formData).forEach((key) => {
            data.append(key, formData[key]);
        });
    
        try {
            await axios.post("/api/businesses", data, {
                headers: {
                    Authorization: `Bearer ${localStorage.getItem("token")}`,
                    "Content-Type": "multipart/form-data",
                },
            });
            toast.success("Business created successfully!");
            onSuccess(); // Notifica al componente padre que se creó un negocio
            setFormData({ // Resetea los campos del formulario
                name: "",
                email: "",
                phone: "",
                address: "",
                description: "",
                logo: null,
            });
        } catch (error) {
            toast.error("Failed to create business.");
            console.error(error);
        }
    };

    return (
        <form
            onSubmit={handleSubmit}
            className="grid grid-cols-2 gap-4 p-4 bg-white shadow-md rounded"
        >
            <input
                type="text"
                name="name"
                placeholder="Name"
                value={formData.name}
                onChange={handleChange}
                className="p-2 border rounded"
            />
            <input
                type="email"
                name="email"
                placeholder="Email"
                value={formData.email}
                onChange={handleChange}
                className="p-2 border rounded"
            />
            <input
                type="text"
                name="phone"
                placeholder="Phone"
                value={formData.phone}
                onChange={handleChange}
                className="p-2 border rounded"
            />
            <input
                type="text"
                name="address"
                placeholder="Address"
                value={formData.address}
                onChange={handleChange}
                className="p-2 border rounded"
            />
            <textarea
                name="description"
                placeholder="Description"
                value={formData.description}
                onChange={handleChange}
                className="p-2 border rounded"
            ></textarea>
            <input
                type="file"
                name="logo"
                onChange={handleFileChange}
                className="p-2 border rounded"
            />
            <button
                type="submit"
                className="col-span-2 bg-blue-500 text-white rounded px-4 py-2"
            >
                Save Business
            </button>
        </form>
    );
}
