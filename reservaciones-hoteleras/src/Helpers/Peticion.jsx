export const Peticion = async (
  url,
  metodo,
  datos_guardar = "",
  archivos = false
) => {
  let cargando = true;
  let opciones = {
    method: "GET",
  };

  if (metodo == "GET" || metodo == "DELETE") {
    opciones = {
      method: metodo,
    };
  }

  if (metodo == "POST" || metodo == "PUT") {
    let bodySave = JSON.stringify(datos_guardar);

    if (archivos) {
      opciones = {
        method: bodySave,
        body: body,
      };
    } else {
      opciones = {
        method: metodo,
        body: JSON.stringify(datos_guardar),
        headers: {
          "Content-Type": "application/json",
        },
      };
    }
  }

  const peticion = await fetch(url, opciones);
  let datos = await peticion.json();

  cargando = false;

  return {
    datos,
    cargando,
  };
};
