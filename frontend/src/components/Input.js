export default function Input({ label, placeholder = label, error, ...props }) {
  return (
    <div className="relative my-2">
      <input
        className="peer bg-dark caret-primary w-full text-lg font-body my-2 py-2 px-3 outline-none border-2 rounded-lg border-primary/30 focus:border-primary focus:-translate-y-1 placeholder-transparent transition-all duration-300"
        placeholder={placeholder}
        {...props}
      />
      <label className="absolute -top-4 text-sm mr-0 px-1 left-0 bg-dark text-surface/80 my-2 mx-3 capitalize peer-placeholder-shown:top-2 peer-placeholder-shown:text-lg peer-placeholder-shown:text-surface/50 peer-focus:-top-4 peer-focus:text-sm peer-focus:text-surface/80 transition-all duration-300">
        {label}
      </label>
      {error && <p className="text-sm text-red-500">{error}</p>}
    </div>
  );
}
