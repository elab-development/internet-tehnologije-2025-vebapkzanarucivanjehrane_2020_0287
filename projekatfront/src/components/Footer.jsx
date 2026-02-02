import React from 'react'

import "../styles/Footer.css";

const Footer = () => {
  return (
    <footer className="footer">
      <p className="footer-text">
        © {new Date().getFullYear()} <span>NomNomGo</span> — dostava hrane
      </p>
    </footer>
  );
};

export default Footer;
