import './App.css';
import { BrowserRouter, Routes, Route } from 'react-router-dom';
import Pocetna from './pages/HomePage';
import LoginPage from './pages/LoginPage';
import Restaurants from './pages/Restaurants';
import Navbar from './components/Navbar';
import Footer from './components/Footer';

function App() {
  return (
    <div className="App">
      <BrowserRouter> 
      <Navbar></Navbar>
        <Routes>
          <Route path="/" element={<Pocetna />} />
          <Route path="/login" element={<LoginPage />} />
          <Route path="/restaurants" element={<Restaurants />} />
        </Routes>
        <Footer></Footer>
      </BrowserRouter>






    </div>
  );
}

export default App;
