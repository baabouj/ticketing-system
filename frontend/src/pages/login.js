import { useState } from "react";

import Link from "next/link";

import Button from "@components/Button";
import Input from "@components/Input";
import Layout from "@components/Layout";

import { useAuth } from "@hooks/auth";

import { IoChevronBack } from "react-icons/io5";

export default function Login() {
  const { login } = useAuth({ middleware: "guest" });

  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");
  const [errors, setErrors] = useState({
    email: "",
    password: "",
  });

  const onSubmit = (e) => {
    e.preventDefault();
    login({ email, password, setErrors });
  };

  return (
    <Layout>
      <div className="self-center flex flex-col items-center justify-center h-screen w-fit font-body">
        <div className="flex justify-center items-center relative w-full text-center">
          <Link href="/" passHref>
            <IoChevronBack className="text-2xl absolute left-0 hover:cursor-pointer m-2" />
          </Link>
          <h1 className="text-2xl font-bold">Welcome to Support</h1>
        </div>
        <form className="mt-4" onSubmit={onSubmit}>
          <Input
            label="Email Address"
            type="email"
            value={email}
            onChange={({ target: { value } }) => setEmail(value)}
            error={errors.email}
          />
          <Input
            label="password"
            type="password"
            value={password}
            onChange={({ target: { value } }) => setPassword(value)}
            error={errors.password}
          />
          <div className="flex justify-between items-center">
            <Button label="Log in" />
            <p className="text-sm">
              Don&apos;t have an account?
              <span className="text-primary">
                <Link href="/signup"> Sign up</Link>
              </span>
            </p>
          </div>
        </form>
      </div>
    </Layout>
  );
}
