export default function InputLabel({
    value,
    className = '',
    children,
    ...props
}) {
    return (
        <label
            {...props}
            className={
                `block text-body font-medium  ` +
                className
            }
        >
            {value ? value : children}
        </label>
    );
}
