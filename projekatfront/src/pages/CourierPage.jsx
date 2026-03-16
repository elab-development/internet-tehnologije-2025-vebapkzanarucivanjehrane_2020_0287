import React, { useEffect, useState } from 'react';
import api from '../api/api';
import { useNavigate } from 'react-router-dom';
import { FaMapMarkerAlt, FaMoneyBillWave, FaClock } from 'react-icons/fa';
import "../styles/CourierPage.css";

const CourierPage = () => {
  const navigate = useNavigate();
  const user = JSON.parse(localStorage.getItem("user") || "{}");
  const [porudzbine, setPorudzbine] = useState([]);

  useEffect(() => {
    if (user.role !== 'dostavljac') 
        return;
    api.get('/moje-dostave').then(res => setPorudzbine(res.data));
  }, []);

  if (user.role !== 'dostavljac') {
    navigate('/');
    return null;
  }

  const handleStatus = (id, status) => {
    api.patch(`/porudzbine/${id}/status`, { status })
      .then(() => {
        setPorudzbine(prev =>
          prev.map(p => p.id === id ? { ...p, status } : p)
        );
      })
      .catch(err => console.error(err));
  };

  // sledece dugme za svaki status
  const nextStatus = {
    'na_cekanju': { label: 'Preuzmi', status: 'u_pripremi' },
    'u_pripremi': { label: 'Krenuo na dostavu', status: 'dostava_u_toku' },
    'dostava_u_toku': { label: 'Isporučeno', status: 'isporuceno' },
  };

  return (
    <div className="courier-page">
      <h1>Moje dostave</h1>
      {porudzbine.length === 0 ? (
        <p className="no-orders">Nema dostava.</p>
      ) : (
        porudzbine.map(p => (
          <div key={p.id} className="courier-card">
            <div className="courier-card-left">
              <p className="courier-order-id">Porudžbina #{p.id}</p>
              <p><FaMapMarkerAlt /> {p.adresa_isporuke}</p>
              <p><FaMoneyBillWave /> {p.ukupna_cena} RSD</p>
              <p><FaClock /> {new Date(p.vreme_kreiranja).toLocaleDateString('sr-RS')}</p>
            </div>
            <div className="courier-card-right">
              <span className={`status-badge status-${p.status}`}>{p.status}</span>
              {nextStatus[p.status] && (
                <button
                  className="btn-next-status"
                  onClick={() => handleStatus(p.id, nextStatus[p.status].status)}
                >
                  {nextStatus[p.status].label}
                </button>
              )}
            </div>
          </div>
        ))
      )}
    </div>
  );
};

export default CourierPage;