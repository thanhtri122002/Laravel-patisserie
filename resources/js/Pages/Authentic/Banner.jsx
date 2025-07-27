import PrimaryButton from "../../Components/PrimaryButton";

export default function Banner({ isLogin, children, togglingForm, className = '', ...props }) {
    const sideClass = isLogin ? 'rounded-r-xl' : 'rounded-l-xl';
    const translateClass = isLogin ? 'translate-x-full' : 'translate-x-0';

    const sharedTransition = 'transition-all duration-1000';

    return (
        <div className={`absolute h-full w-[50%] ${translateClass} ${sideClass} ${sharedTransition} ${className}`} {...props}>
            <div className={`relative w-full h-full ${sideClass} ${sharedTransition}`}>
                {/* Overlay Layer */}
                <div className={`absolute inset-0 z-10 opacity-50 bg-[--Layered-Overlay] ${sideClass} ${sharedTransition}`} />
                
                {/* Background Image */}
                <div className={`absolute inset-0 z-0 ${sideClass} ${sharedTransition}`}>
                    <img 
                        src="storage/images/elements/authentic-banner.jpg" 
                        alt="" 
                        className={`w-full h-full object-cover ${sideClass} ${sharedTransition}`} 
                    />
                </div>

                {/* Centered Content */}
                <div className={`absolute left-1/2 top-1/2 transform -translate-x-1/2 -translate-y-1/2 w-[70%] z-20 ${sideClass} relative h-[140px]`}>
                    {/* Login block */}
                    <div className={`absolute inset-0 transition-all duration-700 ease-in-out 
                        ${isLogin ? 'opacity-100 translate-y-0 pointer-events-auto' : 'opacity-0 -translate-y-4 pointer-events-none'}`}>
                        <p className="font-mer text-h2 text-[--Pink-Secondary]">Don't have an account?</p>
                        <PrimaryButton className="w-full justify-center" onClick={togglingForm}>
                            <p className="font-mer text-body">Register now !</p>
                        </PrimaryButton>
                    </div>

                    {/* Register block */}
                    <div className={`absolute inset-0 transition-all duration-700 ease-in-out 
                        ${!isLogin ? 'opacity-100 translate-y-0 pointer-events-auto' : 'opacity-0 -translate-y-4 pointer-events-none'}`}>
                            
                        <p className="font-mer text-h2 text-[--Pink-Secondary]">Already have an account?</p>
                        <PrimaryButton className="w-full justify-center" onClick={togglingForm}>
                            <p className="font-mer text-body">Log into your account</p>
                        </PrimaryButton>
                    </div>
                </div>
            </div>
        </div>
    );
}
