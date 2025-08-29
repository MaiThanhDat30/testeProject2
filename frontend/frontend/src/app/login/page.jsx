"use client";

import { useState } from "react";
import { useRouter } from "next/navigation"; // Next 13 app directory

export default function TestLogin() {
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");
  const [token, setToken] = useState("");
  const [result, setResult] = useState("");

  const router = useRouter();
  const backendUrl = "http://localhost:8000/api";

  const login = async () => {
    try {
      const res = await fetch(`${backendUrl}/login`, {
        method: "POST",
        headers: { 
          "Content-Type": "application/json", 
          "Accept": "application/json",
        },
        body: JSON.stringify({ email, password }),
      });

      const data = await res.json();
      setResult(JSON.stringify(data, null, 4));

      if (res.ok && data.token) {
        setToken(data.token);
        localStorage.setItem("token", data.token);
        localStorage.setItem("role", data.user.role); // lưu role

        // Redirect dựa vào role
        if (data.user.role === "admin") {
          router.push("/admin"); // sang trang admin
        } else {
          router.push("/"); // sang trang user bình thường
        }
      }
    } catch (err) {
      setResult("Error: " + err.message);
    }
  };

  return (
    <div style={{ padding: 20 }}>
      <h2>Login</h2>
      <input
        type="email"
        placeholder="Email"
        value={email}
        onChange={(e) => setEmail(e.target.value)}
        style={{ marginRight: 10 }}
      />
      <input
        type="password"
        placeholder="Password"
        value={password}
        onChange={(e) => setPassword(e.target.value)}
        style={{ marginRight: 10 }}
      />
      <button onClick={login}>Login</button>

    

    </div>
  );
}
