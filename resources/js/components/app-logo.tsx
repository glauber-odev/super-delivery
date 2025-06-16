
    const logoURL = `/logos/logo.svg`

export default function AppLogo() {
    return (
        <>
            <div className="flex aspect-square size-8 items-center justify-center rounded-md bg-sidebar text-sidebar-primary-foreground">
                <img src={logoURL} className="size-5 fill-current text-white dark:text-black" />
            </div>
            <div className="ml-1 grid flex-1 text-left text-sm">
                <span className="mb-0.5 truncate leading-tight font-semibold">Super Delivery</span>
            </div>
        </>
    );
}
