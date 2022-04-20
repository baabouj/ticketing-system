export default function Layout({ children }) {
  return (
    <div className="flex flex-col min-h-screen bg-dark text-surface">
      {children}
    </div>
  );
}
