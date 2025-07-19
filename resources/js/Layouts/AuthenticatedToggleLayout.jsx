import '../../scss/pages/login/_login.scss';

export default function AuthenticatedToggleLayout({ children }) {
    
    return (
        <div className="w-full h-dvh">
            <div className="w-full h-dvh flex relative overflow-hidden">
                {children}
            </div>
        </div>
    );
}