import React from 'react';
import Image from 'next/image';
import AppLayout from '../Layouts/AppLayout';
export default function Home() {
  
  const handleLogin = () => {
    window.location.href = "http://localhost:3065/api/auth/login";
  }
  return (
    <div>
      <button onClick={handleLogin}>시작하기</button>
    </div>
  )
}