import React from 'react';
import './index.css';  // Asegúrate de que tienes tu archivo CSS importado
import ClubsList from './ClubsList';

export default function App() {
  return (
    <>
      <h1 className="text-3xl bg-red-500 font-bold underline">
        Hello world!
      </h1>
      <div className="bg-gray-100 min-h-screen p-6">
        <ClubsList />
      </div>
    </>
    
  )
}