"use client";

import { useEffect, useState } from "react";

export default function AdminBooks() {
  const [books, setBooks] = useState([]);
  const [token, setToken] = useState("");

  const backendUrl = "http://localhost:8000/api";

  // Lấy token từ localStorage **trên client** khi component mount
  useEffect(() => {
    const t = localStorage.getItem("token");
    if (t) setToken(t);
  }, []);

  const fetchBooks = async () => {
    if (!token) return;
    const res = await fetch(`${backendUrl}/books`, {
      headers: {
        Authorization: `Bearer ${token}`,
        Accept: "application/json",
      },
    });
    const data = await res.json();
    setBooks(data);
  };

  useEffect(() => {
    fetchBooks();
  }, [token]);

  return (
    <div>
      <h1>Admin Books</h1>
      <pre>{JSON.stringify(books, null, 2)}</pre>
    </div>
  );
}
