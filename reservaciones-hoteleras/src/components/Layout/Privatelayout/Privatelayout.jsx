import React from "react";
import { PrivateNav } from "./PrivateNav";
import { Outlet } from "react-router-dom";

export const Privatelayout = () => {
  return (
    <>
      {/* nav */}
      <PrivateNav />
      {/* layout */}
      <Outlet />
    </>
  );
};
