import React from "react";
import { Route, Routes, BrowserRouter, Navigate } from "react-router-dom";
import { PublicLayout } from "../components/Layout/Publiclayout/PublicLayout";
import { Login } from "../components/Users/Login";
import { Register } from "../components/Users/Register";
import { Privatelayout } from "../components/Layout/Privatelayout/Privatelayout";
import { Bookings } from "../components/Booking/Bookings";

export const Routing = () => {
  return (
    <BrowserRouter>
      <Routes>
        <Route path="/" element={<PublicLayout />}>
          <Route index element={<Login />} />
          <Route path="login" element={<Login />} />
          <Route path="registro" element={<Register />} />
        </Route>

        <Route path="/reservaciones" element={<Privatelayout />}>
          <Route index element={<Bookings />} />
          <Route path="reservas" element={<Bookings />} />
        </Route>
      </Routes>
    </BrowserRouter>
  );
};
