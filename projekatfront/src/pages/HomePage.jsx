import React, { useState } from "react";
import { FaUtensils, FaShoppingCart, FaRegClock, FaBolt, FaPizzaSlice, FaHamburger, FaLeaf, FaFish } from 'react-icons/fa';
import "../styles/HomePage.css";
import { Link, useNavigate } from 'react-router-dom';
import CourierModal from "../components/CourierModal";

const HomePage = () => {
  const navigate = useNavigate();
  const isAuth = !!localStorage.getItem("token");
  const [open, setOpen] = useState(false);

  return (
    <div className="homepage">

      <div className="hero">
        <div className="hero-left">
          <div className="hero-tag">
            <div className="hero-tag-dot"></div>
            <span>Dostava hrane #1</span>
          </div>
          <h1>Hrana<br/>koju <em>voliš,</em><br/><span className="outline">dostavljena brzo.</span></h1>
          <p className="hero-sub">Poruči iz najboljih restorana u svom gradu — bez čekanja, samo nekoliko klikova.</p>
          {!isAuth && (
            <div className="hero-actions">
              <button className="btn-main" onClick={() => navigate("/login")}>
                Naruči sada <span className="arrow">→</span>
              </button>
              <button className="btn-ghost" onClick={() => navigate("/register")}>
                Registruj se
              </button>
            </div>
          )}
          <div className="hero-stats">
            <div className="hero-stat"><strong>100+</strong><span>restorana</span></div>
            <div className="hero-stat"><strong>30 min</strong><span>prosečna dostava</span></div>
            <div className="hero-stat"><strong>50k+</strong><span>korisnika</span></div>
          </div>
        </div>

        <div className="hero-right">
          <div className="hero-img-wrap">
            <div className="food-circle">🍔</div>
            <div className="float-badge2"><span>★ 4.9</span></div>
            <div className="float-badge">
              <div className="float-badge-icon"><FaBolt /></div>
              <div><p>Brza dostava</p><span>~25 minuta</span></div>
            </div>
            <div className="float-price"><span>od 490 din</span></div>
          </div>
        </div>
      </div>

      <div className="marquee-wrap">
        <div className="marquee">
          <span>Brza dostava</span><span className="marquee-dot"> ✦ </span>
          <span>100+ restorana</span><span className="marquee-dot"> ✦ </span>
          <span>Sigurno plaćanje</span><span className="marquee-dot"> ✦ </span>
          <span>Ocena 4.9</span><span className="marquee-dot"> ✦ </span>
          <span>Brza dostava</span><span className="marquee-dot"> ✦ </span>
          <span>100+ restorana</span><span className="marquee-dot"> ✦ </span>
          <span>Sigurno plaćanje</span><span className="marquee-dot"> ✦ </span>
          <span>Ocena 4.9</span><span className="marquee-dot"> ✦ </span>
        </div>
      </div>

      <div className="categories">
        <div className="cat-header">
          <h2>Šta ti se jede?</h2>
          <Link to="/restorani">Svi restorani →</Link>
        </div>
        <div className="cat-grid">
          <div className="cat-card"><div className="cat-icon"><FaPizzaSlice /></div><h3>Pizza</h3><span>12 restorana</span></div>
          <div className="cat-card"><div className="cat-icon"><FaHamburger /></div><h3>Burgeri</h3><span>18 restorana</span></div>
          <div className="cat-card"><div className="cat-icon"><FaFish /></div><h3>Sushi</h3><span>7 restorana</span></div>
          <div className="cat-card"><div className="cat-icon"><FaLeaf /></div><h3>Salate</h3><span>9 restorana</span></div>
        </div>
      </div>

      <div className="how">
        <div className="how-header">
          <div>
            <p className="how-label">Kako funkcioniše naša aplikacija</p>
            <h2>3 jednostavna <em>koraka</em></h2>
          </div>
        </div>
        <div className="how-grid">
          <div className="how-step">
            <div className="how-num">01</div>
            <div className="how-step-icon"><FaUtensils /></div>
            <h3>Izaberi restoran</h3>
            <p>Pregledaj restorane u blizini i filtriraj po kategorijama.</p>
          </div>
          <div className="how-step">
            <div className="how-num">02</div>
            <div className="how-step-icon"><FaShoppingCart /></div>
            <h3>Dodaj u korpu</h3>
            <p>Izaberi jela, dodaj priloge i potvrdi porudžbinu.</p>
          </div>
          <div className="how-step">
            <div className="how-num">03</div>
            <div className="how-step-icon"><FaRegClock /></div>
            <h3>Sačekaj dostavu</h3>
            <p>Prati porudžbinu uživo i čekaj da hrana stigne topla.</p>
          </div>
        </div>
      </div>

      <div className="partner-section">
        <div className="pcard del">
          <p className="pcard-tag">Za dostavljače</p>
          <h2>Radi kada želiš</h2>
          <ul>
            <li>Zarada po isporuci</li>
            <li>Fleksibilno radno vreme</li>
            <li>Brza isplata</li>
          </ul>
          <button className="courier-btn pcta" onClick={() => setOpen(true)}>Postani dostavljač</button>
        </div>
      </div>

      {open && <CourierModal onClose={() => setOpen(false)} />}
    </div>
  );
};

export default HomePage;