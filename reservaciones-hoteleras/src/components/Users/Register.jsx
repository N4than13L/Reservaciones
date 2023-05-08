import React from "react";

export const Register = () => {
  return (
    <>
      <form className="text-center mt-3 border border-primary p-5">
        {/* nombre */}
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">
            Nombre
          </label>
          <input type="text" class="form-control" id="exampleInputEmail1" />
        </div>

        {/* apellido */}
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">
            apellido
          </label>
          <input type="text" class="form-control" id="exampleInputEmail1" />
        </div>

        {/* email */}
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">
            Email
          </label>
          <input type="email" class="form-control" id="exampleInputEmail1" />
        </div>

        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">
            contrasena
          </label>
          <input type="password" class="form-control" id="exampleInputEmail1" />
        </div>

        <button type="submit" class="btn btn-primary">
          Submit
        </button>
      </form>
    </>
  );
};
