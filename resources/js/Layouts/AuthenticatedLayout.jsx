export default function AuthenticatedLayout({ children }) {

    return (
        <>
            <div className="h-dvh flex items-center justify-center">
                <div className="absolute inset-0 opacity-50 bg-[--Layered-Overlay] z-10"></div>
                <div className="absolute inset-0 z-0">
                    <img className="w-full h-full object-cover" src="storage/images/elements/authentic-background.jpg" alt="" />
                </div>
                {children}
            </div>
        </>
    );
}