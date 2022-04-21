import { useState } from "react";

import Link from "next/link";

import Button from "@components/Button";
import Input from "@components/Input";
import Layout from "@components/Layout";

import { useAuth } from "@hooks/auth";

import { IoChevronBack } from "react-icons/io5";

export default function Signup() {
  const [name, setName] = useState("");
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");
  const [errors, setErrors] = useState({
    name: "",
    email: "",
    password: "",
  });

  const { signup } = useAuth({ middleware: "guest" });

  const onSubmit = (e) => {
    e.preventDefault();
    signup({ name, email, password, setErrors });
  };

  return (
    <Layout center>
      <div>
        <div className="flex justify-center items-center relative w-full text-center py-2">
          <Link href="/" passHref>
            <IoChevronBack className="text-2xl absolute left-0 hover:cursor-pointer m-2" />
          </Link>
          <h1 className="text-2xl font-bold">Welcome to Support</h1>
        </div>
        <form className="mt-4" onSubmit={onSubmit}>
          <Input
            label="Name"
            type="text"
            value={name}
            onChange={({ target: { value } }) => setName(value)}
            error={errors.name}
          />
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
            <Button label="Sign up" />
            <p className="text-sm">
              Already have an account?
              <span className="text-primary">
                <Link href="/login"> Log in</Link>
              </span>
            </p>
          </div>
        </form>
      </div>
    </Layout>
  );
}
