<?php

namespace GlaivePro\SF\OGC\Contracts;

/**
 * Defines geometry model according to
 * 6.1.9 MultiLineString
 * of "OpenGIS® Implementation Standard for Geographic information - Simple
 * feature access - Part 1: Common architecture" Version 1.2.1
 *
 * Q: Why aren't numPoints and pointN here like on LineString?
 */
interface MultiLineString extends MultiCurve {}
