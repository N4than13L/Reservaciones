import React from "react";
import { Outlet } from "react-router-dom";
import { PublicNav } from "./PublicNav";

export const PublicLayout = () => {
  return (
    <>
      {/* navbar */}
      <PublicNav />
      {/* layout a cargar. */}
      <section className="container">
        <Outlet />
      </section>
    </>
  );
};
