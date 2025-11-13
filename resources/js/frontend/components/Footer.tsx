import { Link } from "react-router-dom";
import {
    GraduationCap,
    Mail,
    Phone,
    MapPin,
    Facebook,
    Twitter,
    Linkedin,
    Instagram,
} from "lucide-react";

const Footer = () => {
    return (
        <footer className="bg-card border-t border-border">
            <div className="container mx-auto px-4 py-12">
                <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    {/* Brand */}
                    <div className="space-y-4">
                        <div className="flex items-center space-x-2">
                            <GraduationCap className="h-8 w-8 text-primary" />
                            <div>
                                <span className="font-bold text-lg">
                                    MIS Alumni
                                </span>
                                <p className="text-xs text-muted-foreground">
                                    Modern Indian School
                                </p>
                            </div>
                        </div>
                        <p className="text-sm text-muted-foreground">
                            Connecting MIS graduates worldwide, fostering
                            lifelong relationships and professional growth.
                        </p>
                        <div className="flex space-x-3">
                            <a
                                href="#"
                                className="p-2 rounded-full bg-secondary hover:bg-primary hover:text-primary-foreground transition-colors"
                            >
                                <Facebook className="h-4 w-4" />
                            </a>
                            <a
                                href="#"
                                className="p-2 rounded-full bg-secondary hover:bg-primary hover:text-primary-foreground transition-colors"
                            >
                                <Twitter className="h-4 w-4" />
                            </a>
                            <a
                                href="#"
                                className="p-2 rounded-full bg-secondary hover:bg-primary hover:text-primary-foreground transition-colors"
                            >
                                <Linkedin className="h-4 w-4" />
                            </a>
                            <a
                                href="#"
                                className="p-2 rounded-full bg-secondary hover:bg-primary hover:text-primary-foreground transition-colors"
                            >
                                <Instagram className="h-4 w-4" />
                            </a>
                        </div>
                    </div>

                    {/* Quick Links */}
                    <div>
                        <h3 className="font-semibold text-lg mb-4">
                            Quick Links
                        </h3>
                        <ul className="space-y-2">
                            <li>
                                <Link
                                    to="/"
                                    className="text-muted-foreground hover:text-primary transition-colors"
                                >
                                    Home
                                </Link>
                            </li>
                            <li>
                                <Link
                                    to="/about"
                                    className="text-muted-foreground hover:text-primary transition-colors"
                                >
                                    About Us
                                </Link>
                            </li>
                            <li>
                                <Link
                                    to="/clubs"
                                    className="text-muted-foreground hover:text-primary transition-colors"
                                >
                                    Clubs
                                </Link>
                            </li>
                            <li>
                                <Link
                                    to="/events"
                                    className="text-muted-foreground hover:text-primary transition-colors"
                                >
                                    Events
                                </Link>
                            </li>
                            <li>
                                <Link
                                    to="/committees"
                                    className="text-muted-foreground hover:text-primary transition-colors"
                                >
                                    Committees
                                </Link>
                            </li>
                        </ul>
                    </div>

                    {/* Resources */}
                    <div>
                        <h3 className="font-semibold text-lg mb-4">
                            Resources
                        </h3>
                        <ul className="space-y-2">
                            <li>
                                <Link
                                    to="/directory"
                                    className="text-muted-foreground hover:text-primary transition-colors"
                                >
                                    Member Directory
                                </Link>
                            </li>
                            <li>
                                <Link
                                    to="/gallery"
                                    className="text-muted-foreground hover:text-primary transition-colors"
                                >
                                    Photo Gallery
                                </Link>
                            </li>
                            <li>
                                <Link
                                    to="/contact"
                                    className="text-muted-foreground hover:text-primary transition-colors"
                                >
                                    Contact Us
                                </Link>
                            </li>
                            <li>
                                <a
                                    href="#"
                                    className="text-muted-foreground hover:text-primary transition-colors"
                                >
                                    Newsletter
                                </a>
                            </li>
                            <li>
                                <a
                                    href="#"
                                    className="text-muted-foreground hover:text-primary transition-colors"
                                >
                                    Support
                                </a>
                            </li>
                        </ul>
                    </div>

                    {/* Contact */}
                    <div>
                        <h3 className="font-semibold text-lg mb-4">
                            Contact Us
                        </h3>
                        <ul className="space-y-3">
                            <li className="flex items-start space-x-3">
                                <MapPin className="h-5 w-5 text-primary mt-0.5 flex-shrink-0" />
                                <span className="text-sm text-muted-foreground">
                                    Modern Indian School
                                    <br />
                                    Alumni Office, Main Campus
                                </span>
                            </li>
                            <li className="flex items-center space-x-3">
                                <Mail className="h-5 w-5 text-primary flex-shrink-0" />
                                <a
                                    href="mailto:alumni@mis.edu"
                                    className="text-sm text-muted-foreground hover:text-primary transition-colors"
                                >
                                    alumni@mis.edu
                                </a>
                            </li>
                            <li className="flex items-center space-x-3">
                                <Phone className="h-5 w-5 text-primary flex-shrink-0" />
                                <a
                                    href="tel:+1234567890"
                                    className="text-sm text-muted-foreground hover:text-primary transition-colors"
                                >
                                    +123 456 7890
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div className="border-t border-border mt-8 pt-8 text-center">
                    <p className="text-sm text-muted-foreground">
                        © {new Date().getFullYear()} MIS Alumni Network. All
                        rights reserved.
                    </p>
                </div>
            </div>
        </footer>
    );
};

export default Footer;
