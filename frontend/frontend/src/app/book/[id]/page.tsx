"use client";

import { useParams, useRouter } from "next/navigation";
import { useEffect, useState } from "react";
import axios from "axios";

interface Book {
  id: number;
  title: string;
  author: string;
  description: string;
  published_year: number;
}

export default function BookDetailPage() {
  const params = useParams() as { id: string };
  const router = useRouter();
  const [book, setBook] = useState<Book | null>(null);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState<string | null>(null);

  useEffect(() => {
    if (!params?.id) return;
    axios.get(`http://localhost:8000/api/books/${params.id}`)
      .then(res => { setBook(res.data); setLoading(false); })
      .catch(() => { setError("Không tìm thấy sách"); setLoading(false); });
  }, [params?.id]);

  if (loading) return <p>Đang tải...</p>;
  if (error) return <p style={{ color: "red" }}>{error}</p>;

  return (
    <div>
      <h1>{book?.title}</h1>
      <p><b>Tác giả:</b> {book?.author}</p>
      <p><b>Năm xuất bản:</b> {book?.published_year}</p>
      <p><b>Mô tả:</b> {book?.description}</p>
      <button onClick={() => router.back()}>Quay lại</button>
    </div>
  );
}
