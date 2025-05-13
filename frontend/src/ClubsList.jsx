import React, { useEffect, useState } from 'react';

const ClubsList = () => {
  const [clubs, setClubs] = useState([]);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    fetch('http://localhost:8000/api/clubs')
      .then((response) => response.json())
      .then((data) => {
        setClubs(data);
        setLoading(false);
      })
      .catch((error) => {
        console.error('Error fetching clubs:', error);
        setLoading(false);
      });
  }, []);

  if (loading) {
    return <p className="text-center text-gray-500">Cargando clubes...</p>;
  }

  return (
    <div className="max-w-4xl mx-auto mt-8 p-4 bg-white shadow-md rounded-md">
      <h1 className="text-2xl font-bold text-center text-indigo-600 mb-4">Lista de Clubes</h1>
      <ul className="divide-y divide-gray-200">
        {clubs.map((club) => (
          <li key={club.id} className="py-4">
            <div className="flex justify-between items-center">
              <div>
                <p className="text-lg font-semibold text-gray-800">{club.name}</p>
                <p className="text-sm text-gray-500">Isla: {club.island}</p>
              </div>
              <span className="inline-block px-3 py-1 text-sm bg-indigo-100 text-indigo-600 rounded-full">
                ID: {club.id}
              </span>
            </div>
          </li>
        ))}
      </ul>
    </div>
  );
};

export default ClubsList;
