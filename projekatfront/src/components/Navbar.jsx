import React from "react";
import { Link } from "react-router-dom";

const styles = {
  navbar: {
    position: "sticky",
    zIndex: 100,
    display: "flex",
    justifyContent: "space-between",
    padding: "14px 32px",

    background: "rgba(255, 255, 255, 0.15)",
    backdropFilter: "blur(14px)",
    WebkitBackdropFilter: "blur(14px)",

    borderBottom: "1px solid rgba(255, 255, 255, 0.25)",
    boxShadow: "0 8px 30px rgba(0, 0, 0, 0.25)"
  },

  left: {
    display: "flex",
    alignItems: "center",
    gap: "16px"
  },

  logo: {
    fontSize: "22px",
    fontWeight: 900,
    letterSpacing: "1px",
    color: "#d3e5d9",
    textDecoration: "none"
  },

  logoSpan: {
    color: "#265d34"
  },

  right: {
    display: "flex",
    alignItems: "center",
    gap: "20px"
  },

  link: {
    textDecoration: "none",
    color: "#265d34",
    fontSize: "15px",
    fontWeight: 500,
    padding: "6px 14px",
    borderRadius: "999px",
    transition: "all 0.25s ease"
  }
};

const Navbar = () => {
  return (
    <nav style={styles.navbar}>
      <div style={styles.left}>
        <Link to="/" style={styles.logo}>
          Food<span style={styles.logoSpan}>EXPRESS</span>
        </Link>
      </div>


      <div style={styles.right}>
        <Link to="/" style={styles.link}>
          Početna
        </Link>
        <Link to="/login" style={styles.link}>
          Login
        </Link>
        <Link to="/register" style={styles.link}>
          Registracija
        </Link>
      </div>
    </nav>
  );
};

export default Navbar;