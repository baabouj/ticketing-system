import { useEffect } from "react";

import useSWR from "swr";

import { useRouter } from "next/router";

import axios from "@lib/axios";

export const useAuth = ({ middleware }) => {
  const router = useRouter();
  const {
    data: user,
    error,
    mutate,
  } = useSWR("user", () =>
    axios
      .get("/user", {
        headers: {
          Authorization: "Bearer " + sessionStorage.getItem("token"),
        },
      })
      .then((res) => res.data)
  );

  const login = async ({ email, password, setErrors }) => {
    try {
      const response = await axios.post("/auth/login", { email, password });
      sessionStorage.setItem("token", response.data.token);
      mutate();
      setErrors({
        email: response.data.message,
        password: response.data.message,
      });
    } catch ({
      response: {
        data: { errors },
      },
    }) {
      console.log(errors);
      setErrors(errors);
    }
  };

  const signup = async ({ name, email, password, setErrors }) => {
    try {
      const response = await axios.post("/auth/signup", {
        name,
        email,
        password,
      });
      sessionStorage.setItem("token", response.data.token);
      mutate();
    } catch ({
      response: {
        data: { errors },
      },
    }) {
      setErrors(errors);
    }
  };

  const logout = async () => {
    await axios.get("/auth/logout", {
      headers: {
        Authorization: "Bearer " + sessionStorage.getItem("token"),
      },
    });
    sessionStorage.removeItem("token");
    mutate(null);
    router.push("/");
  };

  useEffect(() => {
    if (middleware === "guest" && user) router.push("/");
    if (middleware == "auth" && !user && error) router.push("/login");
  }, [user, error]);

  return {
    user,
    login,
    signup,
    logout,
    isLoggedIn: !!user,
    isLoading: !user && !error,
  };
};
