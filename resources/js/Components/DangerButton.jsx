export default function DangerButton({
    className = '',
    disabled,
    children,
    ...props
}) {
    return (
        <button
            {...props}
            className={
                `inline-flex items-center rounded-md border border-transparent bg-red-600 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition duration-150 ease-in-out hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 active:bg-red-700 ${
                    disabled && 'opacity-25'
                } ` + className
            }
            disabled={disabled}
        >
            {children}
        </button>
    );
}
/* 
Short-Circuiting:

The && operator evaluates expressions from left to right.
It "short-circuits" if the left side is false (or a "falsy" value - see point 3). If the left side is false, the overall result must be false regardless of the right side, so JavaScript doesn't even bother evaluating the right side.
tsx


let count = 0;
false && (count = 1); // The right side (count = 1) is never executed
console.log(count);   // Output: 0

true && (count = 1);  // The right side IS executed because the left is true
console.log(count);   // Output: 1

Return Value (Beyond Booleans):

This is the crucial part for understanding its use in your className example.
Unlike some languages, && in JavaScript doesn't always return true or false. It returns the value of one of the operands.
It evaluates from left to right:
If the first operand is "falsy" (values like false, 0, "" (empty string), null, , NaN), it stops and returns that falsy value immediately.
If the first operand is "truthy" (any value that is not falsy), it continues to evaluate the second operand. It then returns the value of the second operand.
tsx


console.log(0 && 'hello');      // Output: 0 (0 is falsy, returns 0)
console.log('' && 'world');     // Output: '' (empty string is falsy, returns '')
console.log(null && 'test');    // Output: null (null is falsy, returns null)
console.log(true && 'result');  // Output: 'result' (true is truthy, returns the right side)
console.log('abc' && 123);      // Output: 123 ('abc' is truthy, returns the right side)
console.log(1 && 0);            // Output: 0 (1 is truthy, evaluates right side, 0 is falsy, returns 0)
...1 lines truncated. Use the buttons above to view or insert the full code.

Connecting back to disabled && 'opacity-25':

In your DangerButton.jsx component:

tsx


`${
    disabled && 'opacity-25'
} ` + className
The disabled prop is either true or false.
If disabled is true (truthy), the && operator evaluates the right side ('opacity-25') and returns the string 'opacity-25'. This string is then included in the template literal, becoming part of the final className.
If disabled is false (falsy), the && operator stops at disabled and returns false. When false is included in a string template literal, it effectively adds nothing that CSS recognizes as a class.
*/

