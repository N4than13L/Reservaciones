import React from "react";

export const Nav = () => {
  return (
    <nav className="navbar navbar-expand-lg bg-info">
      <div className="container-fluid">
        <a className="navbar-brand" href="#">
          Reservaciones Hoteleras
        </a>
        <button
          className="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span className="navbar-toggler-icon"></span>
        </button>
        <div className="collapse navbar-collapse" id="navbarSupportedContent">
          <ul className="navbar-nav me-auto mb-2 mb-lg-0">
            <li className="nav-item">
              <a className="nav-link active" aria-current="page" href="#">
                Inicio
              </a>
            </li>
            <li className="nav-item">
              <a className="nav-link" href="#">
                Reservaciones
              </a>
            </li>
            <li className="nav-item">
              <a className="nav-link" href="#">
                Guardar Reservaciones
              </a>
            </li>
          </ul>
          {/* inicio perfil */}
          <section className="d-flex" role="search">
            <li className="nav-item dropdown text-decoration-none">
              <a
                className="nav-link dropdown-toggle"
                href="#"
                role="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >
                Perfil
              </a>
              <ul className="dropdown-menu">
                <li>
                  <a className="dropdown-item" href="#">
                    Configuracion
                  </a>
                </li>
                <li>
                  <a className="dropdown-item" href="#">
                    Cerrar sesion
                  </a>
                </li>
              </ul>
            </li>
          </section>
          {/* fin perfil */}
        </div>
      </div>
    </nav>
  );
};
