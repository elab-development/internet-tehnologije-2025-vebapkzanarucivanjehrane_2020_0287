import React from "react";
import FeatureCard from "../components/FeatureCard";
import { FaBolt, FaCreditCard, FaRegClock, FaShoppingCart, FaStore, FaUtensils} from 'react-icons/fa';
import "../styles/HomePage.css";
import { Link } from "react-router-dom";
const HomePage = () => {

  const features = [
    {
      id: '1',
      Icon: <FaUtensils />,
      title: "Izaberi restoran",
      items: [
        "Pregledaj restorane u svojoj blizini",
        "Filtriraj po kategorijama",
        "Izaberi ono što ti se jede"
      ]
    },
    {
      id: '2',
      Icon: <FaShoppingCart />,
      title: "Dodaj u korpu",
      items: [
        "Izaberi jela i količinu",
        "Dodaj priloge i napomene",
        "Jednostavna potvrda porudžbine"
      ]
    },
    {
      id: '3',
      Icon: <FaRegClock />,
      title: "Sačekaj dostavu",
      items: [
        "Prati porudžbinu u realnom vremenu",
        "Brza i sigurna isporuka",
        "Hrana stiže topla"
      ]
    }
  ];

  const whyUsFeatures = [
    {
      id: '4',
      Icon: <FaBolt />,
      title: "Brza dostava",
      items: [
        "Dostavljači u tvojoj blizini",
        "Minimalno vreme čekanja"
      ]
    },
    {
      id: '5',
      Icon: <FaStore />,
      title: "Veliki izbor restorana",
      items: [
        "Brza hrana, domaća kuhinja",
        "Picerije i poslastičarnice"
      ]
    },
    {
      id: '6',
      Icon: <FaCreditCard />,
      title: "Sigurno plaćanje",
      items: [
        "Plaćanje karticom",
        "Plaćanje pouzećem"
      ]
    }
  ];

  const partnerFeatures = [
    {
      id: '7',
      title: "ZA RESTORANE",
      items: [
        "Povećaj broj porudžbina",
        "Veća vidljivost restorana",
        "Jednostavno upravljanje ponudom"
      ]
    },
    {
      id: '8',
      title: "ZA DOSTAVLJAČE",
      items: [
        "Radi kada želiš",
        "Zarada po isporuci",
        "Fleksibilno radno vreme"
      ]
    }
  ];

  return (
    <div className="homepage">
      <div className="homepage-main">
        <div className="homepage-left">
          <h1 className="homepage-title">NomNomGo - Tvoja omiljena hrana, dostavljena brzo i sigurno</h1>
          <p className="homepage-subtitle">
            Poruči iz najboljih restorana u svom gradu - bez čekanja, bez gužve, samo nekoliko klikova.
          </p>

          <div className="homepage-hero-actions">
            <button className = "btn-primary">
              Prijavi se <Link to="/login"></Link>
              </button>
          </div>
        </div>

        <div className="homepage-right">
            <section className="homepage-section">
              <h2>Šta nudi NomNomGo?</h2>
                <p className="homepage-section-subtitle">
                    Brza, sigurna i pouzdana dostava hrane iz tvojih omiljenih restorana, direktno na tvoja vrata.
                </p>
            </section>

            <section className="homepage-grid">
              {features.map((feature, index) => (
                <FeatureCard
                  key={feature.id}
                  Icon = {feature.Icon}
                  title={feature.title}
                  items={feature.items}
                />
                ))}
            </section>

            <section className="homepage-title-whyus">
                <h3>Zašto baš mi?</h3>
                <div className="homepage-grid-whyus">
                  {whyUsFeatures.map((feature, index) => (
                     <FeatureCard
                       key={feature.id}
                        Icon = {feature.Icon}
                        title={feature.title}
                        items={feature.items}
                    />
                    ))}
                </div>
             </section>
           </div>
          </div>
          
            <section className="homepage-grid-partner">
              <h3>Postani naš partner!</h3>
                {partnerFeatures.map((feature, index) => (
                  <FeatureCard
                    key={feature.id}
                    title={feature.title}
                    items={feature.items}
                />
                ))}
            </section>
      </div>
  );
};

export default HomePage;