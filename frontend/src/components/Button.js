export default function Button({ label, ...props }) {
  return (
    <button
      className="bg-primary font-body text-lg px-3 py-2 my-2 rounded-lg hover:bg-primary/80 transition-all duration-300"
      {...props}
    >
      {label}
    </button>
  );
}
