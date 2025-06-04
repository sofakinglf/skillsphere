// src/components/ProtectedRoute.js
import React from "react";
import { Navigate } from "react-router-dom";

export default function ProtectedRoute({ children }) {
  const token = localStorage.getItem("token"); // or use cookies/session

  if (!token) {
    return <Navigate to="/login" replace />;
  }

  return children;
}
