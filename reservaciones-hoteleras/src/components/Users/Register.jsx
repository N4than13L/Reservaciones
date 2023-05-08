import React from "react";
import { UseForm } from "../../Hooks/UseForm";
import { Global } from "../../Helpers/Global";

export const Register = () => {
  const { form, changed } = UseForm({});

  const saveUser = async (e) => {
    // paara no recargar la pagina
    e.preventDefault();

    // inicializamos el objeto a enviar al api.
    let newUser = form;

    // guardar usuario en el backend.
    let request = await fetch(Global.url + "/register", {
      method: "POST",
      body: JSON.stringify(newUser),
      headers: {
        "Content-Type": "application/json",
      },
    });

    let data = await request.json();
    console.log(data);
  };

  return (
    <section>
      <h2 className="mt-2">Formulario de registro</h2>
      <form
        className="text-center border border-primary p-3"
        onSubmit={saveUser}
      >
        {/* nombre */}
        <div className="mb-3">
          <label htmlFor="name" className="form-label">
            Nombre
          </label>
          <input
            type="text"
            name="name"
            className="form-control"
            onChange={changed}
          />
        </div>

        {/* apellido */}
        <div className="mb-3">
          <label htmlFor="surname" className="form-label">
            apellido
          </label>
          <input
            type="text"
            name="surname"
            className="form-control"
            onChange={changed}
          />
        </div>

        {/* email */}
        <div class="mb-3">
          <label htmlFor="email" className="form-label">
            Email
          </label>
          <input
            type="email"
            name="email"
            className="form-control"
            onChange={changed}
          />
        </div>

        {/* contrasena  */}
        <div className="mb-3">
          <label htmlFor="password" className="form-label">
            contrasena
          </label>
          <input
            type="password"
            name="password"
            className="form-control"
            onChange={changed}
          />
        </div>

        <input type="submit" value="Registrate" className="btn btn-success" />
      </form>
    </section>
  );
};
