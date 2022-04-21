export default function Layout({ center = false, children }) {
  return (
    <div
      className={`flex flex-col min-h-screen bg-dark text-surface font-body ${
        center && "justify-center items-center"
      }`}
    >
      {children}
    </div>
  );
}
