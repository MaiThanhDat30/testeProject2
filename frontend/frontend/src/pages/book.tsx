import { useEffect, useState } from 'react';
import axios from 'axios';

interface Category {
  id: number;
  name: string;
}

interface Book {
  id: number;
  title: string;
  author: string;
  category: Category;
  description: string;
  published_year: number;
}

export default function BooksPage() {
  const [books, setBooks] = useState<Book[]>([]);

  useEffect(() => {
    axios.get<Book[]>('http://localhost:8000/api/books')
      .then(res => setBooks(res.data))
      .catch(err => console.error(err));
  }, []);

  return (
    <div>
      <h1>Danh sách sách</h1>
      <ul>
        {books.map(book => (
          <li key={book.id}>
            {book.title} - {book.author} (Thể loại: {book.category.name})
          </li>
        ))}
      </ul>
    </div>
  );
}
