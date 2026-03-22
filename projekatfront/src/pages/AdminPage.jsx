import React, { useEffect, useState } from 'react';
import api from '../api/api';
import { useNavigate } from 'react-router-dom';
import { FaMapMarkerAlt, FaCar, FaPhone, FaStickyNote } from 'react-icons/fa';
import "../styles/AdminPage.css";

const AdminPage = () => {
  const navigate = useNavigate();
  const user = JSON.parse(localStorage.getItem("user") || "{}"); //citamo ko je ulogovan iz local storage-a, da bismo mogli da proverimo njegovu ulogu
  const [dostavljaci, setDostavljaci] = useState([]);

  useEffect(() => {
    if (user.role !== 'admin') return; // ako nije admin, ne ucitavaj nista
    api.get('/dostavljaci').then(res => {
      const sortirani = res.data.sort((a, b) => { //sortiramo dostavljace tako da oni koji su na cekanju budu prvi na listi
        if (a.status === 'na_cekanju' && b.status !== 'na_cekanju') 
          return -1;
        if (b.status === 'na_cekanju' && a.status !== 'na_cekanju') 
          return 1;
        return 0;});
      setDostavljaci(sortirani);
    });
  }, []);

  // zastita - ako nije admin, vrati ga na početnu
  if (user.role !== 'admin') {
    navigate('/');
    return null;
  }

  const handleStatus = (id, status) => {
    api.patch(`/dostavljaci/${id}/status`, { status }) //saljemo novi status dostavljaca na server
      .then(() => {
        setDostavljaci(prev =>
          prev.map(d => d.id === id ? { ...d, status } : d) //nakon sto server uspešno promeni status, azuriramo stanje dostavljaca, tako da se nova informacija odmah prikaze na stranici
        );
      })
      .catch(err => console.error(err));
  };

  return (
    <div className="admin-page">
      <h1>Zahtevi za dostavljače</h1>
      {dostavljaci.length === 0 ? (
        <p>Nema zahteva.</p>
      ) : (
        dostavljaci.map(d => (
          <div key={d.id} className="admin-card">
            <div className="admin-card-left">
              <p className="admin-name">{d.ime}</p>
              <p>
                <FaMapMarkerAlt /> {d.grad} &nbsp;|&nbsp;
                <FaCar /> {d.vozilo} &nbsp;|&nbsp;
                <FaPhone /> {d.kontakt}
              </p>
              {d.napomena && <p><FaStickyNote /> {d.napomena}</p>}
            </div>

            <div className="admin-card-right">
              <span className={`status-badge status-${d.status}`}>{d.status}</span>
              {d.status === 'na_cekanju' && ( //dugmici se prikazuju samo dok je status dostavljaca "na_cekanju"
                <div className="admin-actions">
                  <button className="btn-odobri" onClick={() => handleStatus(d.id, 'odobren')}>Odobri</button>
                  <button className="btn-odbij" onClick={() => handleStatus(d.id, 'odbijen')}>Odbij</button>
                </div>
              )}
            </div>
          </div>
        ))
      )}
    </div>
  );
};

export default AdminPage;