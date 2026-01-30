import React from 'react'

const Footer = () => {

 const footerStyle = {
    padding: "16px 0",
    backgroundColor: "#f8fafc",
    color: "#4F5D2F",
  };

  const textStyle = {
    opacity: 0.85,
  };

   return (
    <footer style={footerStyle}>
      <span style={textStyle}>
        © {new Date().getFullYear()} NomNomGo dostava hrane
      </span>
    </footer>
  );
};

export default Footer;
