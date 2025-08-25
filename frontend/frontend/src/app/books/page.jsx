"use client";

import { useEffect, useState } from "react";
import { useRouter } from "next/navigation";
import axios from "axios";

export default function BooksPage() {
  const router = useRouter();
  const [books, setBooks] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);

  // Form
  const [formTitle, setFormTitle] = useState("");
  const [formAuthor, setFormAuthor] = useState("");
  const [formDesc, setFormDesc] = useState("");
  const [formYear, setFormYear] = useState("");
  const [formImage, setFormImage] = useState(null);
  const [editingId, setEditingId] = useState(null);

  const fetchBooks = () => {
    setLoading(true);
    axios.get("http://localhost:8000/api/books")
      .then(res => {
        setBooks(res.data);
        setLoading(false);
      })
      .catch(() => {
        setError("Lỗi khi tải dữ liệu");
        setLoading(false);
      });
  };

  useEffect(() => {
    fetchBooks();
  }, []);

  const handleDelete = (id) => {
    if (!confirm("Bạn có chắc chắn muốn xoá sách này?")) return;
    axios.delete(`http://localhost:8000/api/books/${id}`)
      .then(() => fetchBooks())
      .catch(() => alert("Xoá thất bại"));
  };

  const handleSubmit = () => {
  const data = new FormData();
  data.append("title", formTitle);
  data.append("author", formAuthor);
  data.append("description", formDesc);
  data.append("published_year", formYear);
  if (formImage) data.append("image", formImage);

  if (editingId) {
    // Sửa sách
   axios.post(`http://localhost:8000/api/books/${editingId}?_method=PUT`, data)
      .then(() => {
        alert("Sửa sách thành công!");
        fetchBooks();
        resetForm();
      })
      .catch(() => alert("Sửa thất bại"));
  } else {
    // Thêm sách
    axios.post("http://localhost:8000/api/books", data)
      .then(() => {
        alert("Thêm sách thành công!");
        fetchBooks();
        resetForm();
      })
      .catch(err => {
        console.log(err.response?.data || err.message);
        alert("Thêm sách thất bại");
      });
  }
};


  const editBook = (book) => {
    setEditingId(book.id);
    setFormTitle(book.title);
    setFormAuthor(book.author);
    setFormDesc(book.description);
    setFormYear(book.published_year);
  };

  const resetForm = () => {
    setEditingId(null);
    setFormTitle("");
    setFormAuthor("");
    setFormDesc("");
    setFormYear("");
    setFormImage(null);
    const fileInput = document.getElementById("fileInput");
    if (fileInput) fileInput.value = "";
  };

  if (loading) return <p>Đang tải dữ liệu...</p>;
  if (error) return <p style={{ color: "red" }}>{error}</p>;

  return (
   <div>
  <h1 style={{ textAlign: "center", marginBottom: "20px" }}>📚 Danh sách sách</h1>

  {/* Form Thêm / Sửa */}
  <div style={{ marginBottom: "30px", padding: "15px", border: "1px solid #ccc", borderRadius: "8px", maxWidth: "600px", marginLeft: "auto", marginRight: "auto" }}>
    <input style={{ display: "block", marginBottom: "10px", width: "100%", padding: "8px" }} placeholder="Title" value={formTitle} onChange={e => setFormTitle(e.target.value)} />
    <input style={{ display: "block", marginBottom: "10px", width: "100%", padding: "8px" }} placeholder="Author" value={formAuthor} onChange={e => setFormAuthor(e.target.value)} />
    <input style={{ display: "block", marginBottom: "10px", width: "100%", padding: "8px" }} placeholder="Description" value={formDesc} onChange={e => setFormDesc(e.target.value)} />
    <input style={{ display: "block", marginBottom: "10px", width: "100%", padding: "8px" }} placeholder="Year" value={formYear} onChange={e => setFormYear(e.target.value)} />
    <input
      id="fileInput"
      type="file"
      style={{ marginBottom: "10px" }}
      onChange={e => { if (e.target.files && e.target.files[0]) setFormImage(e.target.files[0]); }}
    />
    <div>
      <button onClick={handleSubmit} style={{ marginRight: "10px" }}>{editingId ? "Sửa sách" : "Thêm sách"}</button>
      {editingId && <button onClick={resetForm}>Huỷ</button>}
    </div>
  </div>

  {/* Grid sách */}
  <div style={{ display: "grid", gridTemplateColumns: "repeat(auto-fill, minmax(180px, 1fr))", gap: "20px" }}>
    {books.map(book => (
      <div key={book.id} style={{ border: "1px solid #ccc", borderRadius: "8px", padding: "10px", textAlign: "center", boxShadow: "0 2px 5px rgba(0,0,0,0.1)" }}>
        {book.image ? (
          <img src={`http://localhost:8000${book.image}`} alt={book.title} style={{ width: "100%", height: "220px", objectFit: "cover", borderRadius: "4px", marginBottom: "10px" }} />
        ) : (
          <div style={{ width: "100%", height: "220px", display: "flex", alignItems: "center", justifyContent: "center", backgroundColor: "#f0f0f0", marginBottom: "10px", borderRadius: "4px" }}>
            Chưa có ảnh
          </div>
        )}
        <b style={{ display: "block", marginBottom: "5px" }}>{book.title}</b>
        <span style={{ display: "block", color: "#555", marginBottom: "5px" }}>{book.author}</span>
        <span style={{ display: "block", color: "#999", marginBottom: "10px" }}>{book.published_year}</span>
        <div>
          <button onClick={() => editBook(book)} style={{ marginRight: "5px" }}>Sửa</button>
          <button onClick={() => handleDelete(book.id)} style={{ marginRight: "5px" }}>Xoá</button>
          <button onClick={() => router.push(`/book/${book.id}`)}>Xem</button>
        </div>
      </div>
    ))}
  </div>
</div>


  );
}
