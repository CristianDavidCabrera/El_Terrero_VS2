import React from 'react';
import './index.css';  // Asegúrate de que tienes tu archivo CSS importado
import ClubsList from './ClubsList';

export default function App() {
  return (
    <>
      <div className="bg-gray-100 min-h-screen p-6">
        <ClubsList />
      </div>
    </>
    
  )
}