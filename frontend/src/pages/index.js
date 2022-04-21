import Button from "@components/Button";
import Layout from "@components/Layout";
import Spinner from "@components/Spinner";
import { useAuth } from "@hooks/auth";
import Link from "next/link";

export default function Home() {
  const { user, logout, isLoggedIn, isLoading } = useAuth({
    middleware: "guest",
  });

  if (isLoading) {
    return (
      <Layout center>
        <Spinner />
      </Layout>
    );
  }

  return (
    <Layout center>
      {isLoggedIn ? (
        <>
          <h1 className="text-xl font-body">Welcome {user.name}</h1>
          <Button label="Log out" onClick={logout} />
        </>
      ) : (
        <>
          <h1 className="text-xl font-body">Welcome!</h1>
          <Link href="/login" passHref>
            <Button label="Log in" />
          </Link>
        </>
      )}
    </Layout>
  );
}
